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
        'material_id',
        'time_limit',
        'max_attempts',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('order');
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function userAttempts($userId)
    {
        return $this->attempts()->where('user_id', $userId);
    }

    public function getUserBestScore($userId)
    {
        return $this->userAttempts($userId)->max('score') ?? 0;
    }

    public function getTotalPoints()
    {
        return $this->questions()->sum('points');
    }
}
