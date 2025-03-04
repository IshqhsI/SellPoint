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
        'total_price',
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
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }

    // schema products
    // {
    //     "type": "array",
    //     "items": {
    //         "type": "object",
    //         "properties": {
    //             "id": {
    //                 "type": "integer"
    //             },
    //             "name": {
    //                 "type": "string"
    //             },
    //             "price": {
    //                 "type": "integer"
    //             },
    //             "quantity": {
    //                 "type": "integer"
    //             },
    //             "subtotal": {
    //                 "type": "integer"
    //             },
    //         }
    //     }
    // }

}
