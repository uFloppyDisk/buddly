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
            'title' => "Interest Category ".fake()->words(2, true),
            'description' => fake()->sentence(10),
            'description_long' => fake()->text(100)
        ];
    }
}
