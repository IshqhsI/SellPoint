<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class Form extends Component
{
    public ?Category $category;
    public $name;

    public function mount(Category $category = null)
    {
        if ($category) {
            $this->category = $category;
            $this->name = $category->name;
        }
    }

    public function render()
    {
        return view('livewire.category.form');
    }

    public function save()
    {
        $this->validate();

        Category::updateOrCreate([
            'id' => $this->category ? $this->category->id : null,
        ], [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    protected function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
