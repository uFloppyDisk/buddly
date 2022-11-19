<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('type', false, true)->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('name_first')->nullable();
            $table->string('name_last')->nullable();
            $table->string('name_middle')->nullable();
            $table->integer('age', false, true)->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });

        // DB::table('account')->insert([
        //     array(
        //         'email' => 'example@buddly.ca',
        //         'password' => Hash::make('password'),
        //         'name_first' => 'Example',
        //         'name_last' => 'User'
        //     ),
        //     array(
        //         'email' => 'example2@buddly.ca',
        //         'password' => Hash::make('password'),
        //         'name_first' => 'Second Example',
        //         'name_last' => 'User'
        //     )
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account');
    }
};
