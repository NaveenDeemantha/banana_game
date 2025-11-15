<?php

use App\Http\Controllers\GameScoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\GameScoreManagementController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/', function () {
    // Redirect to landing page
    return redirect()->route('landing');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public landing page
Route::get('/landing', function () {
    return Inertia::render('Landing/index');
})->name('landing');

// Public leaderboard (can be viewed by anyone)
Route::get('/leaderboard', function () {
    return Inertia::render('Leaderboard/index');
})->name('leaderboard');

// Protected game routes - require authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        return Inertia::render('Home/index');
    })->name('home');

    Route::get('/difficulty', function () {
        return Inertia::render('Difficulty/index');
    })->name('difficulty');

    Route::get('/play', function () {
        return Inertia::render('Play/index');
    })->name('play');

    Route::get('/result', function (Request $request) {
        $score = $request->query('score', 0);
        $correct = $request->query('correct', 0);
        $total = $request->query('total', 0);
        $difficulty = $request->query('difficulty', 'medium');

        // Calculate accuracy
        $accuracy = $total > 0 ? round(($correct / $total) * 100) : 0;

        // Calculate time bonus (placeholder logic - adjust as needed)
        $timeBonus = $correct * 2;

        // Check if it's a new record for the user
        $newRecord = false;
        if (Auth::check()) {
            $bestScore = Auth::user()->gameScores()
                ->where('difficulty', $difficulty)
                ->max('score');
            $newRecord = $score > ($bestScore ?? 0);
        }

        return Inertia::render('Result/index', [
            'gameResults' => [
                'score' => (int) $score,
                'totalQuestions' => (int) $total,
                'correctAnswers' => (int) $correct,
                'difficulty' => ucfirst($difficulty),
                'timeBonus' => $timeBonus,
                'accuracy' => $accuracy,
                'newRecord' => $newRecord,
            ]
        ]);
    })->name('result');

    Route::get('/settings', function () {
        return Inertia::render('Settings/index');
    })->name('settings');
});

// API routes for game scores - require verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/api/scores', [GameScoreController::class, 'store'])->name('scores.store');
    Route::get('/api/scores/history', [GameScoreController::class, 'userHistory'])->name('scores.history');
});

Route::get('/api/leaderboard', [GameScoreController::class, 'leaderboard'])->name('leaderboard.api');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes - protected by admin middleware and email verification
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // User management
    Route::resource('users', UserManagementController::class);

    // Game score management
    Route::resource('scores', GameScoreManagementController::class)->except(['create', 'store']);
    Route::post('/scores/delete-multiple', [GameScoreManagementController::class, 'destroyMultiple'])->name('scores.destroy-multiple');
});

require __DIR__.'/auth.php';
