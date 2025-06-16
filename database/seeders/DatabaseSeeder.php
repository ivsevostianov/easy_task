<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users for IDOR protection testing
        $user1 = User::create([
            'name' => 'Alice Test',
            'email' => 'alice@example.com',
            'password' => Hash::make('SecurePassword123!'),
        ]);

        $user2 = User::create([
            'name' => 'Bob Test',
            'email' => 'bob@example.com',
            'password' => Hash::make('SecurePassword123!'),
        ]);

        // Create some tasks for each user to test IDOR protection
        Task::create([
            'user_id' => $user1->id,
            'title' => 'Alice\'s Private Task',
            'description' => 'This task belongs to Alice and should not be accessible by Bob (IDOR test)',
        ]);

        Task::create([
            'user_id' => $user1->id,
            'title' => 'Alice\'s Secret Project',
            'description' => 'Another private task for IDOR protection testing',
        ]);

        Task::create([
            'user_id' => $user2->id,
            'title' => 'Bob\'s Private Task',
            'description' => 'This task belongs to Bob and should not be accessible by Alice (IDOR test)',
        ]);

        Task::create([
            'user_id' => $user2->id,
            'title' => 'Bob\'s Confidential Work',
            'description' => 'Another private task for IDOR protection testing',
        ]);

        // Additional test users
        User::create([
            'name' => 'Test User 1',
            'email' => 'test1@example.com',
            'password' => Hash::make('SecurePassword123!'),
        ]);

        User::create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => Hash::make('SecurePassword123!'),
        ]);
    }
}
