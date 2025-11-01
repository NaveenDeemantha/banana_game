<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameScore extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'correct_answers',
        'total_questions',
        'difficulty',
        'time_taken',
    ];

    protected $casts = [
        'score' => 'integer',
        'correct_answers' => 'integer',
        'total_questions' => 'integer',
        'time_taken' => 'integer',
    ];

    /**
     * Get the user that owns the game score.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
