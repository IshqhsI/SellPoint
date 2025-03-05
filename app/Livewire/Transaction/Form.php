<?php

namespace App\Livewire\Transaction;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;

class Form extends Component
{
    public $allProducts;
    public $allStatus;
    public $allPaymentMethod;
    public $allUsers;

    public $products = [];
    public $total, $status, $payment_method, $user_id;

    public function mount()
    {
        $this->setupData();
    }

    public function render()
    {
        return view('livewire.transaction.form');
    }

    public function addProductField()
    {
        $this->products[] = ['id' => '', 'quantity' => 1];
    }

    public function removeProductField($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
        $this->calculateTotal();
    }

    public function productSelected($productId, $index)
    {
        $product = Product::find($productId);
        $this->products[$index]['id'] = $product->id;
        $this->products[$index]['name'] = $product->name;
        $this->products[$index]['price'] = $product->price;
        $this->products[$index]['subtotal'] = $product->price * $this->products[$index]['quantity'];
        $this->calculateTotal();
    }

    public function quantityChanged($quantity, $index)
    {
        if($quantity > 0 && isset($this->products[$index]['price'])) {
            $this->products[$index]['quantity'] = $quantity;
            $this->products[$index]['subtotal'] = $this->products[$index]['price'] * $quantity;
            $this->calculateTotal();
        }
    }

    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product['price'] * $product['quantity'];
        }
        $this->total = $total;
    }

    public function save(){
        $this->validate();

        $transaction = Transaction::create([
            'products' => json_encode($this->products),
            'total' => $this->total,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'user_id' => $this->user_id,
        ]);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction created successfully.');
    }

    protected function rules()
    {
        return [
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:0',
            'status' => 'required',
            'payment_method' => 'required',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function setupData()
    {
        $this->total = 0;
        $this->status = '';
        $this->payment_method = '';
        $this->user_id = '';


        $this->allProducts = Product::all();
        $this->allStatus = ['pending', 'success', 'failed'];
        $this->allPaymentMethod = ['cash', 'transfer', 'credit card'];
        $this->allUsers = User::all();

        $this->products = [
            [
                'id' => '',
                'quantity' => 1,
            ]
        ];
    }
}
