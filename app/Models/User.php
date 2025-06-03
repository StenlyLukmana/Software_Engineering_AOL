<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is lecturer
     */
    public function isLecturer()
    {
        return $this->role === 'lecturer';
    }

    /**
     * Check if user is student
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Check if user can manage content (admin or lecturer)
     */
    public function canManageContent()
    {
        return in_array($this->role, ['admin', 'lecturer']);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function materialProgress()
    {
        return $this->hasMany(MaterialProgress::class);
    }

    public function getSubjectGrade($subjectId)
    {
        $quizzes = Quiz::whereHas('material', function($query) use ($subjectId) {
            $query->where('subject_id', $subjectId);
        })->get();

        if ($quizzes->isEmpty()) {
            return null;
        }

        $totalScore = 0;
        $totalPossible = 0;
        $completedQuizzes = 0;

        foreach ($quizzes as $quiz) {
            $bestScore = $quiz->getUserBestScore($this->id);
            if ($bestScore > 0) {
                $totalScore += $bestScore;
                $totalPossible += $quiz->getTotalPoints();
                $completedQuizzes++;
            }
        }

        if ($completedQuizzes == 0) {
            return null;
        }

        $percentage = ($totalScore / $totalPossible) * 100;
        
        if ($percentage >= 90) return 'A';
        if ($percentage >= 85) return 'A-';
        if ($percentage >= 80) return 'B+';
        if ($percentage >= 75) return 'B';
        if ($percentage >= 70) return 'B-';
        if ($percentage >= 65) return 'C';
        if ($percentage >= 50) return 'D';
        return 'F';
    }

    public function getSubjectProgress($subjectId)
    {
        $materials = Material::where('subject_id', $subjectId)->get();
        if ($materials->isEmpty()) {
            return 0;
        }

        $totalProgress = 0;
        foreach ($materials as $material) {
            $progress = $material->getUserProgress($this->id);
            $totalProgress += $progress ? $progress->progress_percentage : 0;
        }

        return $totalProgress / $materials->count();
    }
}
