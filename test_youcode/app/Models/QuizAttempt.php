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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
   
    public function scopePassing($query)
    {
        return $query->where('passed', true);
    }
    
    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at');
    }
}