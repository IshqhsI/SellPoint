<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

class Table extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        return view('livewire.product.table', [
            'products' => Product::with('category')->latest()->paginate(5),
        ]);
    }

    public function delete($id){
        Product::findOrFail($id)->delete();

        Session::flash('success', 'Product deleted successfully');
    }
}
