<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration_minutes',
        'passing_score',
        'is_active',
        'is_published'
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}