<?php

namespace App\Livewire\Category;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        return view('livewire.category.table', [
            'categories' => Category::paginate(5),
        ]);
    }

    public function delete($id)
    {
        Category::find($id)->delete();

        Session::flash('success', 'Category deleted successfully');
    }
}
