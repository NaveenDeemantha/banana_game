<?php

namespace App\Http\Controllers;

use App\Models\GameScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameScoreController extends Controller
{
    /**
     * Store a new game score.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:0',
            'correct_answers' => 'required|integer|min:0',
            'total_questions' => 'required|integer|min:0',
            'difficulty' => 'required|in:easy,medium,hard',
            'time_taken' => 'nullable|integer|min:0',
        ]);

        $gameScore = Auth::user()->gameScores()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Score saved successfully!',
            'data' => $gameScore,
        ], 201);
    }

    /**
     * Get leaderboard data.
     */
    public function leaderboard(Request $request)
    {
        $difficulty = $request->query('difficulty'); // optional filter
        $limit = $request->query('limit', 10);

        $query = GameScore::with('user:id,name')
            ->select('user_id')
            ->selectRaw('MAX(score) as best_score')
            ->selectRaw('MAX(correct_answers) as best_correct_answers')
            ->selectRaw('MAX(created_at) as last_played');

        if ($difficulty) {
            $query->where('difficulty', $difficulty);
        }

        $leaderboard = $query
            ->groupBy('user_id')
            ->orderByDesc('best_score')
            ->limit($limit)
            ->get()
            ->map(function ($entry) {
                return [
                    'user_id' => $entry->user_id,
                    'name' => $entry->user->name,
                    'score' => $entry->best_score,
                    'correct_answers' => $entry->best_correct_answers,
                    'last_played' => $entry->last_played,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $leaderboard,
        ]);
    }

    /**
     * Get user's game history.
     */
    public function userHistory(Request $request)
    {
        $user = Auth::user();
        
        $history = $user->gameScores()
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $stats = [
            'total_games' => $user->gameScores()->count(),
            'best_score' => $user->gameScores()->max('score'),
            'average_score' => round($user->gameScores()->avg('score'), 2),
            'total_correct' => $user->gameScores()->sum('correct_answers'),
            'best_easy' => $user->bestScore('easy'),
            'best_medium' => $user->bestScore('medium'),
            'best_hard' => $user->bestScore('hard'),
        ];

        return response()->json([
            'success' => true,
            'history' => $history,
            'stats' => $stats,
        ]);
    }
}
