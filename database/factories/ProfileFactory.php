<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'account_id' => fake()->unique()->randomElement(Account::all()),
            'is_renter' => fake()->boolean(30),
            'bio' => fake()->realText(250),
            'gender' => fake()->numberBetween(0, 2),
            'birthdate' => fake()->date('Y-m-d', strtotime("-18 year", time()))
        ];
    }
}
