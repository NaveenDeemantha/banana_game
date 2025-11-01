<?php

namespace Database\Seeders;

use App\Models\GameScore;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some test users if they don't exist
        $users = [
            ['name' => 'Alex Thunder', 'email' => 'alex@example.com'],
            ['name' => 'Naveen Kumar', 'email' => 'naveen@example.com'],
            ['name' => 'Maya Johnson', 'email' => 'maya@example.com'],
            ['name' => 'Sam Wilson', 'email' => 'sam@example.com'],
            ['name' => 'Emma Davis', 'email' => 'emma@example.com'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => bcrypt('password'), // Default password
                ]
            );

            // Create random scores for each difficulty
            foreach (['easy', 'medium', 'hard'] as $difficulty) {
                $numGames = rand(3, 8);
                
                for ($i = 0; $i < $numGames; $i++) {
                    $totalQuestions = rand(5, 15);
                    $correctAnswers = rand(0, $totalQuestions);
                    
                    // Calculate score based on difficulty
                    $basePoints = ['easy' => 10, 'medium' => 20, 'hard' => 30][$difficulty];
                    $score = $correctAnswers * $basePoints + rand(0, $correctAnswers * 5); // Add some time bonus
                    
                    GameScore::create([
                        'user_id' => $user->id,
                        'score' => $score,
                        'correct_answers' => $correctAnswers,
                        'total_questions' => $totalQuestions,
                        'difficulty' => $difficulty,
                        'time_taken' => rand(60, 300), // 1-5 minutes
                        'created_at' => now()->subDays(rand(0, 30)),
                    ]);
                }
            }
        }

        $this->command->info('Game scores seeded successfully!');
    }
}
