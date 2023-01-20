<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detail_issuing>
 */
class Detail_issuingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'issuing_id' => fake()->randomElement([1, 2, 3]),
            'item_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'qty' => fake()->randomDigit(1),
        ];
    }
}
