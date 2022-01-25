<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'ivanphyo',
            'email' => 'ivanphyo2015@gmail.com',
            'role' => '1',
            'email_verified_at' => now(),
            'password' => Hash::make('ivan2020'), // ivan2020
            'remember_token' => Str::random(10),

        ]);
         \App\Models\User::factory(10)->create();
         Feature::factory(10)->create();
         Room::factory(40)->create();
    }
}
