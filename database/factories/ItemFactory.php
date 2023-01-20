<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'category_product_id' => fake()->randomElement([1, 2, 3, 4]),
            'category_brand_id' => fake()->randomElement([1, 2, 3]),
            'qty' => fake()->randomDigit(1),
        ];
    }
}
