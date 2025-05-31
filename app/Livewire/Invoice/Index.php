<?php

namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Transaction;

class Index extends Component
{
    public $transaction;

    public function mount(Transaction $transaction){
        $this->transaction = $transaction;
    }

    public function render()
    {
        return view('livewire.invoice.index', [
            'transaction' => $this->transaction
        ]);
    }


}
