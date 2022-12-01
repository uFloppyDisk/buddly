<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $names = get_names_from_string(fake()->name());

        $area_code = fake()->randomElement([604, 778]);

        $subscriber_num = str_pad((string) fake()->randomNumber(7), 7, "0", STR_PAD_LEFT);
        $phone_number = $area_code.$subscriber_num;

        return [
            'type' => fake()->randomElement([0, 100]),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => now(),
            'phone_number' => $phone_number,
            'name_first' => $names[0],
            'name_last' => $names[2],
            'name_middle' => $names[1][0],
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
