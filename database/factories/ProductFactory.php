<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // encode description json
        $description = $this->faker->text(20);
        $encodedDescription = json_encode($description);

        return [
            'name' => $this->faker->text(8),
            'slug' => $this->faker->slug(2),
            'description' => $encodedDescription,
            'price' => $this->faker->numberBetween(100, 1000),
            'image' => "products/600x400.svg",
            'category_id' => $this->faker->randomElement(Category::pluck('id')),
        ];
    }
}
