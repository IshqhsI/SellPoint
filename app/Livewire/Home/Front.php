<?php

namespace App\Livewire\Home;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class Front extends Component
{
    public $products, $categories, $total, $cash, $change, $search;
    public $cart = [];

    public function mount(){

        // $this->products = Cache::remember('products', 60, function () {
        //     return Product::all();
        // });

        $this->products = Product::all();


        $this->categories = Cache::remember('categories', 60, function () {
            return Category::withCount('products')
                ->orderByDesc('products_count')
                ->get(['id', 'name']);
        });

        $this->total = 0;
        $this->cash = 0;
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
        $this->cart = [];
        session()->forget('cart');
        Cache::forget('products');
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
        $this->total = collect($this->cart)->sum('subtotal');
    }

    public function calculateChange(){
        if($this->cash > $this->total){
            $this->change = $this->cash - $this->total;
        } else {
            $this->change = 0;
        }
    }

}
