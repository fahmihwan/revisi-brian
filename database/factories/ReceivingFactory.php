<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receiving>
 */
class ReceivingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ball_number' => fake()->randomElement(['BALL20020811-1', 'BALL20020811-2', 'BALL20020811-3', 'BALL20020811-4']),
            'supplier_id' => fake()->randomElement([1, 2, 3, 4]),
            'category_product_id' => fake()->randomElement([1, 2, 3, 4]),
            'target_qty' => 40,
            'open_qty' => fake()->randomElement([30, 20, 35]),
            'date' => fake()->randomElement(['2022-08-11', '2022-9-10']),
            'note' => fake()->text(10),
            'price' => fake()->numberBetween($min = 2000000, $max = 5000000),
        ];
    }
}
