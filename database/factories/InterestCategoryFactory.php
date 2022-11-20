<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InterestCategory>
 */
class InterestCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => "Category ".fake()->words(2, true),
            'description' => fake()->realText(30),
            'description_long' => fake()->realText(150)
        ];
    }
}
