<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Slobodan Veselinov',
            'role_id' => '1',
            'email' => 'slobodan.veselinov@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);

        DB::table('users')->insert([
            'name' => 'Sanja Anakieva veselinova',
            'role_id' => '2',
            'email' => 'sanja@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);

         DB::table('users')->insert([
            'name' => 'David Veselinov',
            'role_id' => '3',
            'email' => 'david@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);

        DB::table('users')->insert([
            'name' => 'Jovan Veselinov',
            'role_id' => '3',
            'email' => 'jovan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);
    }
}
