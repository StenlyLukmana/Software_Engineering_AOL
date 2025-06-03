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
    }    /**
     * Get safe options array regardless of how the data is stored
     * 
     * @return array
     */
    public function getOptionsArray()
    {
        if (empty($this->options)) {
            return [];
        }
        
        if (is_array($this->options)) {
            return $this->options;
        }
        
        if (is_string($this->options)) {
            // Try to decode JSON
            $decoded = json_decode($this->options, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            
            // If not valid JSON, split by newlines
            $options = preg_split('/\r?\n/', $this->options);
            return array_values(array_filter(array_map('trim', $options), fn($v) => $v !== ''));
        }
        
        return [];
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
