<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create test player user (optional)
        User::firstOrCreate(
            ['email' => 'player@test.com'],
            [
                'name' => 'Test Player',
                'password' => Hash::make('password'),
                'role' => 'player',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user created successfully!');
        $this->command->info('📧 Email: admin@admin.com');
        $this->command->info('🔑 Password: password');
        $this->command->newLine();
        $this->command->info('✅ Test player created successfully!');
        $this->command->info('📧 Email: player@test.com');
        $this->command->info('🔑 Password: password');
    }
}

