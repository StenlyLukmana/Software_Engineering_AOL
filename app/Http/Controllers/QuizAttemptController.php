<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\MaterialProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
{
    public function start(Quiz $quiz)
    {
        $user = Auth::user();
        
        // Check if user can take this quiz
        $attempts = $quiz->userAttempts($user->id)->count();
        if ($attempts >= $quiz->max_attempts) {
            return redirect()->route('quiz.show', $quiz)
                           ->with('error', 'You have reached the maximum number of attempts for this quiz.');
        }

        // Check if there's an ongoing attempt
        $ongoingAttempt = $quiz->userAttempts($user->id)
                              ->whereNull('completed_at')
                              ->first();

        if ($ongoingAttempt) {
            return redirect()->route('quiz.take', [$quiz, $ongoingAttempt]);
        }

        // Create new attempt
        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'user_id' => $user->id,
            'answers' => [],
            'started_at' => now(),
        ]);

        return redirect()->route('quiz.take', [$quiz, $attempt]);
    }

    public function take(Quiz $quiz, QuizAttempt $attempt)
    {
        // Verify that this attempt belongs to the current user
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if attempt is already completed
        if ($attempt->isCompleted()) {
            return redirect()->route('quiz.result', [$quiz, $attempt]);
        }

        $quiz->load('questions');
        
        // Check time limit
        $timeRemaining = null;
        if ($quiz->time_limit) {
            $elapsed = $attempt->started_at->diffInMinutes(now());
            $timeRemaining = $quiz->time_limit - $elapsed;
            
            if ($timeRemaining <= 0) {
                return $this->submitAttempt($quiz, $attempt, new Request());
            }
        }

        return view('quiz.take', compact('quiz', 'attempt', 'timeRemaining'));
    }

    public function submit(Request $request, Quiz $quiz, QuizAttempt $attempt)
    {
        // Verify that this attempt belongs to the current user
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if attempt is already completed
        if ($attempt->isCompleted()) {
            return redirect()->route('quiz.result', [$quiz, $attempt]);
        }

        return $this->submitAttempt($quiz, $attempt, $request);
    }

    private function submitAttempt(Quiz $quiz, QuizAttempt $attempt, Request $request)
    {
        $quiz->load('questions');
        $answers = $request->input('answers', []);
        
        $totalScore = 0;
        $totalPoints = 0;

        foreach ($quiz->questions as $question) {
            $totalPoints += $question->points;
            $userAnswer = $answers[$question->id] ?? '';
            
            if ($question->checkAnswer($userAnswer)) {
                $totalScore += $question->points;
            }
        }

        $attempt->update([
            'answers' => $answers,
            'score' => $totalScore,
            'total_points' => $totalPoints,
            'completed_at' => now(),
        ]);

        // Update material progress
        $progressPercentage = ($totalScore / $totalPoints) * 100;
        MaterialProgress::updateProgress(
            $attempt->user_id, 
            $quiz->material_id, 
            $progressPercentage >= 70 ? 100 : $progressPercentage
        );

        return redirect()->route('quiz.result', [$quiz, $attempt]);
    }

    public function result(Quiz $quiz, QuizAttempt $attempt)
    {
        // Verify that this attempt belongs to the current user
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        $quiz->load('questions');
        $attempt->load('quiz');

        return view('quiz.result', compact('quiz', 'attempt'));
    }
}
