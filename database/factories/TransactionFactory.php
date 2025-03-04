<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'products' => [
                [
                    'id' => 1,
                    'quantity' => 2,
                    'price' => 5000,
                    'total' => 10000
                ],
                [
                    'id' => 2,
                    'quantity' => 1,
                    'price' => 10000,
                    'total' => 10000
                ]
            ],
            'total' => 15000,
            'status' => 'success',
            'payment_method' => 'cash',
            'user_id' => 1
        ];
    }
}
