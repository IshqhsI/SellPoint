<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'category_id',
    ];

    protected $casts = [
        'description' => 'array',
        'price' => 'integer',
    ];

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true) ?? [],
            set: fn($value) => json_encode($value),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
