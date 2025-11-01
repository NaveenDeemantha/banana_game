<?php

use App\Http\Controllers\GameScoreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Application pages for the Banana game
Route::get('/landing', function () {
    return Inertia::render('Landing/index');
})->name('landing');

Route::get('/home', function () {
    return Inertia::render('Home/index');
})->name('home');

Route::get('/difficulty', function () {
    return Inertia::render('Difficulty/index');
})->name('difficulty');

Route::get('/play', function () {
    return Inertia::render('Play/index');
})->name('play');

Route::get('/result', function () {
    return Inertia::render('Result/index');
})->name('result');

Route::get('/leaderboard', function () {
    return Inertia::render('Leaderboard/index');
})->name('leaderboard');

Route::get('/settings', function () {
    return Inertia::render('Settings/index');
})->name('settings');

// API routes for game scores
Route::middleware('auth')->group(function () {
    Route::post('/api/scores', [GameScoreController::class, 'store'])->name('scores.store');
    Route::get('/api/scores/history', [GameScoreController::class, 'userHistory'])->name('scores.history');
});

Route::get('/api/leaderboard', [GameScoreController::class, 'leaderboard'])->name('leaderboard.api');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
