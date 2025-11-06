<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GameScore;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_players' => User::where('role', 'player')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_games' => GameScore::count(),
            'total_scores' => GameScore::sum('score'),
            'average_score' => round(GameScore::avg('score'), 2),
            'games_today' => GameScore::whereDate('created_at', today())->count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
        ];

        // Recent activities
        $recent_games = GameScore::with('user:id,name,email')
            ->latest()
            ->take(10)
            ->get();

        $recent_users = User::latest()
            ->take(10)
            ->get();

        // Top players
        $top_players = User::withCount('gameScores')
            ->with(['gameScores' => function($query) {
                $query->select('user_id', DB::raw('MAX(score) as best_score'))
                    ->groupBy('user_id');
            }])
            ->where('role', 'player')
            ->orderByDesc('game_scores_count')
            ->take(5)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recent_games' => $recent_games,
            'recent_users' => $recent_users,
            'top_players' => $top_players,
        ]);
    }
}

