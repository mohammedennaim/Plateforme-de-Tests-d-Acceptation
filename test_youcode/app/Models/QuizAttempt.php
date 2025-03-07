<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'passed',
        'answers',
        'completed_at'
    ];

    protected $casts = [
        'answers' => 'array',
        'passed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the quiz attempt.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the quiz for this attempt.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Scope a query to only include attempts by a specific user.
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    
    /**
     * Scope a query to only include passing attempts.
     */
    public function scopePassing($query)
    {
        return $query->where('passed', true);
    }
    
    /**
     * Scope a query to only include completed attempts.
     */
    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at');
    }
}