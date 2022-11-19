<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Account;
use App\Models\Interest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            InterestSeeder::class
        ]);

        Account::factory()
                ->has(Interest::factory()->count(2))
                ->count(10)
                ->create();

        Account::factory()
                ->has(Interest::factory()->count(1))
                ->count(10)
                ->create();
    }
}
