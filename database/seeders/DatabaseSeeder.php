<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TicketUserSeeder;
use Database\Seeders\ProjectUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\Project::factory(5)->create();
        \App\Models\Ticket::factory(15)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TicketUserSeeder::class,
            ProjectUserSeeder::class,
        ]);
        \App\Models\User::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
