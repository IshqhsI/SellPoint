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
            'products' => json_encode([
                [
                    'id' => 1,
                    'name' => fake()->text(5),
                    'quantity' => 2,
                    'price' => 5000,
                    'subtotal' => 10000
                ],
                [
                    'id' => 2,
                    'name' => fake()->text(5),
                    'quantity' => 1,
                    'price' => 10000,
                    'subtotal' => 10000
                ]
            ]),
            'total' => 20000,
            'status' => 'success',
            'payment_method' => 'cash',
            'user_id' => 1
        ];
    }
}
