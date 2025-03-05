<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Transaction;

class Table extends Component
{
    public function render()
    {
        return view('livewire.transaction.table', [
            'transactions' => Transaction::latest()->paginate(5),
        ]);
    }

    public function delete($id)
    {
        $transaction = Transaction::find($id);

        $transaction->delete();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
