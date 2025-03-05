<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'products',
        'total',
        'status',
        'payment_method',
        'user_id',
    ];

    protected $casts = [
        'products' => 'json',
        'total_price' => 'integer',
        'user_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function products(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function totalQuantity(): Attribute
    {
        return Attribute::make(
            get: function ($value){

                $products = is_string($this->products) ? json_decode($this->products, true) : $this->products;

                if (!is_array($products)) {
                    $products = [];
                }

                $totalQty = collect($products)->sum('quantity');

                return $totalQty;
            }
        );
    }

}
