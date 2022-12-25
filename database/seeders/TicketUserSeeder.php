<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 15) as $index)
        {
            DB::table('ticket_user')->insert([
                'ticket_id' => fake()->numberBetween(1,15),
                'user_id' => fake()->numberBetween(1, 12)
            ]);
        }
    }
}
