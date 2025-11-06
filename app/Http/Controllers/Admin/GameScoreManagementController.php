<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameScore;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GameScoreManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GameScore::with('user:id,name,email');

        // Search by user name/email
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by difficulty
        if ($request->has('difficulty') && $request->difficulty !== 'all') {
            $query->where('difficulty', $request->difficulty);
        }

        // Sort by score or date
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $scores = $query->paginate(20)->withQueryString();

        return Inertia::render('Admin/Scores/Index', [
            'scores' => $scores,
            'filters' => $request->only(['search', 'difficulty', 'sort', 'order']),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GameScore $score)
    {
        $score->load('user:id,name,email');

        return Inertia::render('Admin/Scores/Show', [
            'score' => $score,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GameScore $score)
    {
        $score->load('user:id,name,email');

        return Inertia::render('Admin/Scores/Edit', [
            'score' => $score,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameScore $score)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:0',
            'correct_answers' => 'required|integer|min:0',
            'total_questions' => 'required|integer|min:0',
            'difficulty' => 'required|in:easy,medium,hard',
            'time_taken' => 'nullable|integer|min:0',
        ]);

        $score->update($validated);

        return redirect()->route('admin.scores.index')
            ->with('success', 'Score updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameScore $score)
    {
        $score->delete();

        return redirect()->route('admin.scores.index')
            ->with('success', 'Score deleted successfully.');
    }

    /**
     * Delete multiple scores.
     */
    public function destroyMultiple(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:game_scores,id',
        ]);

        GameScore::whereIn('id', $validated['ids'])->delete();

        return back()->with('success', count($validated['ids']) . ' scores deleted successfully.');
    }
}

