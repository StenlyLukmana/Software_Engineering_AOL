<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'answers',
        'score',
        'total_points',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'answers' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPercentageScore()
    {
        if ($this->total_points == 0) return 0;
        return ($this->score / $this->total_points) * 100;
    }    public function getLetterGrade()
    {
        $percentage = $this->getPercentageScore();
        
        if ($percentage >= 90) return 'A';
        if ($percentage >= 85) return 'A-';
        if ($percentage >= 80) return 'B+';
        if ($percentage >= 75) return 'B';
        if ($percentage >= 70) return 'B-';
        if ($percentage >= 65) return 'C';
        if ($percentage >= 50) return 'D';
        return 'F';
    }

    public function isCompleted()
    {
        return !is_null($this->completed_at);
    }
}
