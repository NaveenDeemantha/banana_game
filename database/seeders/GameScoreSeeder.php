<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder is kept for backward compatibility or future game score seeding.
     * Admin and test users are now seeded via AdminUserSeeder.
     */
    public function run(): void
    {
        // You can add sample game scores here if needed
        // For now, this seeder is empty as admin users are handled by AdminUserSeeder
        
        $this->command->info('GameScoreSeeder completed. Use AdminUserSeeder for admin/test users.');
    }
}
