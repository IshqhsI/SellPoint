<?php

namespace App\Livewire\Home;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Front extends Component
{
    public $products, $categories, $total, $cash, $change, $search;
    public $cart = [];

    public function mount(){

        $this->getAllProducts();

        $this->categories = Cache::remember('categories', 60, function () {
            return Category::withCount('products')
                ->orderByDesc('products_count')
                ->get(['id', 'name']);
        });

        $this->total = 0;
        $this->cash = '';
        $this->change = 0;

    }

    public function render()
    {
        return view('livewire.home.front');
    }

    public function getByCategory($id){
        $this->products = Product::where('category_id', $id)->get();
    }

    public function getAllProducts(){
        $this->products = Cache::remember('products', 60, function () {
            return Product::all();
        });
    }

    public function addToCart(Product $product)
    {
        $cartCollection = collect($this->cart);
        $productIndex = $cartCollection->search(fn($item) => $item['id'] === $product->id);

        if ($productIndex !== false) {
            $this->updateCartItem($productIndex);
        } else {
            $this->addNewCartItem($product);
        }

        $this->updateTotal();
    }

    private function updateCartItem(int $index)
    {
        $this->cart[$index]['quantity']++;
        $this->cart[$index]['subtotal'] = $this->cart[$index]['price'] * $this->cart[$index]['quantity'];
        $this->total = collect($this->cart)->sum('subtotal');

        $this->calculateChange();

        $this->dispatch('cart-updated', message: "{$this->cart[$index]['name']} berhasil ditambahkan ke keranjang!");

    }

    private function addNewCartItem(Product $product)
    {
        $this->cart[] = [
            'id' => $product->id,
            'image' => $product->image,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'subtotal' => $product->price
        ];

         $this->dispatch('cart-updated', message: "{$product->name} berhasil ditambahkan ke keranjang!");
    }

    private function updateTotal()
    {
        $this->total = collect($this->cart)->sum('subtotal');
        $this->calculateChange();
    }

    public function getBySearch()
    {
        $this->products = Product::where('name', 'ILIKE', '%' . $this->search . '%')->get();
    }

    public function emptyCart()
    {
        if(empty($this->cart)){
            return;
        }

        $this->cart = [];
        $this->total = 0;
        $this->change = 0;
        $this->cash = '';
        session()->forget('cart');
        Cache::forget('products');

        $this->dispatch('cart-empty', message: "Keranjang berhasil dikosongkan!");
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
        $this->total = collect($this->cart)->sum('subtotal');

        $this->calculateChange();
    }

    public function decrementQuantity($index)
    {
        if ($this->cart[$index]['quantity'] > 1) {
            $this->cart[$index]['quantity']--;
            $this->cart[$index]['subtotal'] = $this->cart[$index]['price'] * $this->cart[$index]['quantity'];
            $this->total = collect($this->cart)->sum('subtotal');
        } else {
            $this->removeFromCart($index);
        }

        $this->calculateChange();

    }

    public function incrementQuantity($index)
    {
        $this->updateCartItem($index);
    }

    public function addCash($amount)
    {
        $this->cash = (int) preg_replace('/[^0-9]/', '', $this->cash);
        $this->cash += $amount;

        $this->calculateChange();
    }

    public function clearCash()
    {
        $this->cash = 0;
        $this->change = 0;
    }

    public function calculateChange()
    {
        $cleanCash = preg_replace('/[^0-9]/', '', $this->cash);
        $cashValue = (int) $cleanCash;
        $this->cash = $cashValue;
        $this->change = $cashValue >= $this->total
            ? $cashValue - $this->total
            : 0;
    }


    public function processPayment(){

        if($this->cash < $this->total){
            $this->dispatch('payment-failed', message: "Uang anda kurang!");
            return;
        }

        // Insert to Transaction
        $transaction = Transaction::create([
            'products' => json_encode($this->cart),
            'total' => $this->total,
            'status' => 'paid',
            'payment_method' => 'cash',
            'user_id' => Auth::user()->id
        ]);

        // Clear Cart
        $this->emptyCart();
        $this->cash = '';
        $this->change = 0;

        return redirect()->route('invoice', $transaction->id)->with('success', 'Transaction created successfully.');
    }

    public function printLastReceipt(){
        $transaction = Transaction::latest()->first();
        return redirect()->route('invoice', $transaction->id);
    }

}
