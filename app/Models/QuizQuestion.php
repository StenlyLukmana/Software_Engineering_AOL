<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'type',
        'options',
        'correct_answer',
        'points',
        'order'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function checkAnswer($userAnswer)
    {
        if ($this->type === 'multiple_choice') {
            return strtolower(trim($userAnswer)) === strtolower(trim($this->correct_answer));
        } elseif ($this->type === 'true_false') {
            return strtolower(trim($userAnswer)) === strtolower(trim($this->correct_answer));
        } else {
            // For text questions, we'll do a simple case-insensitive comparison
            return strtolower(trim($userAnswer)) === strtolower(trim($this->correct_answer));
        }
    }
}
