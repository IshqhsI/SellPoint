<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class Detail extends Component
{
    public $transaction;

    public function mount(Transaction$transaction)
    {
        $this->transaction = $transaction;
    }

    public function render()
    {
        return view('livewire.transaction.detail');
    }
}
