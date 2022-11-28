<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('account')->insert([
        //     'type' => 255,
        //     'email' => 'admin@buddly.ca',
        //     'password' => Hash::make('admin'),
        //     'name_first' => 'Admin',
        //     'name_last' => 'User',
        // ]);
        
        Account::factory()
            ->count(20)
            ->create();

        $interests = Interest::all();
        Account::all()->each(function ($account) use ($interests) {
            $account->interests()->attach(
                $interests->random(rand(1, 4))->pluck('id')->toArray()
            );
        });

        $admin_account = Account::create([
            'type' => 255,
            'email' => 'admin@buddly.ca',
            'password' => Hash::make('admin'),
            'name_first' => 'Admin',
            'name_last' => 'User',
        ]);
        $admin_account->save();
    }
}
