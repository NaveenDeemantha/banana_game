<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

test('authenticated user can save game score', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)->postJson('/api/scores', [
        'score' => 100,
        'correct_answers' => 10,
        'total_questions' => 10,
        'difficulty' => 'easy',
        'time_taken' => 120,
    ]);
    
    $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Score saved successfully!',
            ]);
    
    $this->assertDatabaseHas('game_scores', [
        'user_id' => $user->id,
        'score' => 100,
        'difficulty' => 'easy',
    ]);
});

test('leaderboard returns scores', function () {
    $user = User::factory()->create();
    
    $user->gameScores()->create([
        'score' => 100,
        'correct_answers' => 10,
        'total_questions' => 10,
        'difficulty' => 'easy',
        'time_taken' => 120,
    ]);
    
    $response = $this->getJson('/api/leaderboard');
    
    $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ])
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => ['user_id', 'name', 'score', 'correct_answers', 'last_played']
                ]
            ]);
});
