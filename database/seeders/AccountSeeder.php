<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::factory()
            ->count(20)
            ->create();

        $interests = Interest::all();
        Account::all()->each(function ($account) use ($interests) {
            $account->interests()->attach(
                $interests->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
    }
}
