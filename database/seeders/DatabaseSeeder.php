<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Task::factory()->create([
            'title' => 'Test Task 1',
            'priority' => 1,
        ]);
        Task::factory()->create([
            'title' => 'Test Task 2',
            'priority' => 2,
        ]);
        Task::factory()->create([
            'title' => 'Test Task 3',
            'priority' => 3,
        ]);
        Task::factory()->create([
            'title' => 'Test Task 4',
            'priority' => 4,
        ]);
        Task::factory()->create([
            'title' => 'Test Task 5',
            'priority' => 5,
        ]);
    }
}
