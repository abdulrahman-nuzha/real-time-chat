<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        \App\Models\User::factory(20)->create(); // Create 10 users
        \App\Models\Friend::factory(10)->create(); // Create 20 user relationships
        \App\Models\Room::factory(10)->create();
        \App\Models\Message::factory(50)->create(); // Create 50 messages
    }
}
