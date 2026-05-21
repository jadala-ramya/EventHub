<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin account for the admin dashboard.
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'kurvasucharitha24@gmail.com',
            'role' => 'admin',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
            'password' => 'password',
        ]);
    }
}
