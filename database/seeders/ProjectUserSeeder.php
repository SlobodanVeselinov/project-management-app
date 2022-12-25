<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 5) as $index){
            DB::table('project_user')->insert([
            'project_id' => fake()->numberBetween(1,5),
            'user_id' => fake()->numberBetween(2, 6)
            ]); 
        }
    }
}
