<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Product $product;
    public $categories;
    public $name, $price, $category_id, $image, $description;

    public function mount(Product $product = null)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->description = $product->description;
    }

    public function render()
    {
        $this->categories = Category::all();

        if ($this->description !== []) {
            $this->description = json_decode($this->description);
        }

        return view('livewire.product.form', [
            'categories' => $this->categories,
        ]);
    }

    public function save(){

        $this->validate();

        if (isset($this->description)) {
            $this->description = json_encode($this->description);
        }

        Product::updateOrCreate([
            'id' => $this->product ? $this->product->id : null,
        ], [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'price' => $this->price,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'image' => $this->image ? $this->image->store('products', 'public') : ($this->product->image ?? 'products/600x400.svg'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
        ];
    }
}
