<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Material;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->canManageContent()) {
            $quizzes = Quiz::with(['material.subject', 'questions'])->get();
        } else {
            $quizzes = Quiz::where('is_active', true)
                          ->with(['material.subject', 'questions'])
                          ->get();
        }

        return view('quiz.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load(['questions', 'material.subject']);
        $user = Auth::user();
        
        $attempts = $quiz->userAttempts($user->id)->orderBy('created_at', 'desc')->get();
        $bestScore = $quiz->getUserBestScore($user->id);
        $totalPoints = $quiz->getTotalPoints();
        
        $canTakeQuiz = $attempts->count() < $quiz->max_attempts;
        
        return view('quiz.show', compact('quiz', 'attempts', 'bestScore', 'totalPoints', 'canTakeQuiz'));
    }

    public function create()
    {
        $this->authorize('create', Quiz::class);
        $materials = Material::with('subject')->get();
        return view('quiz.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Quiz::class);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material_id' => 'required|exists:materials,id',
            'time_limit' => 'nullable|integer|min:1',
            'max_attempts' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.type' => 'required|in:multiple_choice,true_false,text',
            'questions.*.correct_answer' => 'required|string',
            'questions.*.points' => 'required|integer|min:1',
        ]);

        $quiz = Quiz::create($request->only([
            'title', 'description', 'material_id', 'time_limit', 'max_attempts'
        ]));

        foreach ($request->questions as $index => $questionData) {
            $question = new QuizQuestion([
                'question' => $questionData['question'],
                'type' => $questionData['type'],
                'correct_answer' => $questionData['correct_answer'],
                'points' => $questionData['points'],
                'order' => $index + 1,
            ]);

            if ($questionData['type'] === 'multiple_choice' && isset($questionData['options'])) {
                $question->options = $questionData['options'];
            }

            $quiz->questions()->save($question);
        }

        return redirect()->route('quiz.show', $quiz)->with('success', 'Quiz created successfully!');
    }

    public function edit(Quiz $quiz)
    {
        $this->authorize('update', $quiz);
        $materials = Material::with('subject')->get();
        $quiz->load('questions');
        return view('quiz.edit', compact('quiz', 'materials'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material_id' => 'required|exists:materials,id',
            'time_limit' => 'nullable|integer|min:1',
            'max_attempts' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $quiz->update($request->only([
            'title', 'description', 'material_id', 'time_limit', 'max_attempts', 'is_active'
        ]));

        return redirect()->route('quiz.show', $quiz)->with('success', 'Quiz updated successfully!');
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorize('delete', $quiz);
        $quiz->delete();
        return redirect()->route('quiz.index')->with('success', 'Quiz deleted successfully!');
    }
}
