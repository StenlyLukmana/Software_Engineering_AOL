@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Results Header -->
    <div class="row mb-4">
        <div class="col-12">
            @php
                $percentage = $attempt->getPercentageScore();
                $letterGrade = $attempt->getLetterGrade();
                $isPassing = $percentage >= 70;
            @endphp
            
            <div class="card card-custom" style="background: linear-gradient(135deg, {{ $isPassing ? '#28a745' : '#dc3545' }} 0%, {{ $isPassing ? '#20c997' : '#e74c3c' }} 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 fw-bold">
                                <i class="fas {{ $isPassing ? 'fa-check-circle' : 'fa-times-circle' }} me-2"></i>
                                Quiz {{ $isPassing ? 'Completed' : 'Completed' }}
                            </h1>
                            <h2 class="mb-1">{{ $quiz->title }}</h2>
                            <p class="mb-0 opacity-75">
                                {{ $quiz->material->subject->name }} - {{ $quiz->material->title }}
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-white bg-opacity-25 rounded p-3">
                                <div class="text-center">
                                    <h3 class="mb-1 fw-bold">{{ $letterGrade }}</h3>
                                    <div class="fw-bold">{{ round($percentage) }}%</div>
                                    <small>{{ $attempt->score }}/{{ $attempt->total_points }} points</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Results Summary -->
        <div class="col-lg-4">
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-pie me-1"></i>Results Summary</h5>
                </div>
                <div class="card-body text-center">
                    <div class="circular-progress mx-auto mb-4" data-percentage="{{ $percentage }}">
                        <div class="circular-progress-inner">
                            <span class="percentage">{{ round($percentage) }}%</span>
                            <small class="grade">{{ $letterGrade }}</small>
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="bg-light rounded p-3 mb-2">
                                <i class="fas fa-check text-success fa-lg mb-1"></i>
                                <h6 class="mb-0">{{ $attempt->score }}</h6>
                                <small class="text-muted">Correct</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light rounded p-3 mb-2">
                                <i class="fas fa-times text-danger fa-lg mb-1"></i>
                                <h6 class="mb-0">{{ $attempt->total_points - $attempt->score }}</h6>
                                <small class="text-muted">Incorrect</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <p class="text-muted small mb-2">
                            <i class="fas fa-clock me-1"></i>
                            Completed: {{ $attempt->completed_at->format('M j, Y g:i A') }}
                        </p>
                        @if($attempt->completed_at && $attempt->started_at)
                            <p class="text-muted small mb-0">
                                <i class="fas fa-stopwatch me-1"></i>
                                Duration: {{ $attempt->started_at->diffForHumans($attempt->completed_at, true) }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card card-custom">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('quiz.show', $quiz) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-1"></i>Back to Quiz
                        </a>
                        <a href="{{ route('subjects.materials', $quiz->material->subject_id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-book me-1"></i>Back to Materials
                        </a>
                        <a href="{{ route('quiz.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-1"></i>All Quizzes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question Review -->
        <div class="col-lg-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-eye me-1"></i>Question Review</h5>
                </div>
                <div class="card-body">
                    @foreach($quiz->questions as $index => $question)
                        @php
                            $userAnswer = $attempt->answers[$question->id] ?? '';
                            $isCorrect = $question->checkAnswer($userAnswer);
                        @endphp
                        
                        <div class="border rounded p-3 mb-3 {{ $isCorrect ? 'border-success bg-success bg-opacity-10' : 'border-danger bg-danger bg-opacity-10' }}">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">
                                    Question {{ $index + 1 }}
                                    <span class="badge {{ $isCorrect ? 'bg-success' : 'bg-danger' }} ms-2">
                                        {{ $isCorrect ? 'Correct' : 'Incorrect' }}
                                    </span>
                                </h6>
                                <span class="badge bg-primary">{{ $question->points }} {{ $question->points == 1 ? 'point' : 'points' }}</span>
                            </div>
                            
                            <p class="mb-3">{{ $question->question }}</p>
                            
                            @if($question->type === 'multiple_choice')
                                @if($question->options)
                                    <div class="row mb-3">
                                        @foreach($question->options as $optIndex => $option)
                                            @php
                                                $optionLetter = chr(65 + $optIndex);
                                                $isUserAnswer = $userAnswer === $optionLetter;
                                                $isCorrectAnswer = $question->correct_answer === $optionLetter;
                                            @endphp
                                            
                                            <div class="col-md-6 mb-1">
                                                <div class="p-2 rounded {{ $isCorrectAnswer ? 'bg-success bg-opacity-25' : ($isUserAnswer ? 'bg-danger bg-opacity-25' : '') }}">
                                                    <span class="badge {{ $isCorrectAnswer ? 'bg-success' : ($isUserAnswer ? 'bg-danger' : 'bg-light text-dark') }} me-2">
                                                        {{ $optionLetter }}
                                                    </span>
                                                    {{ $option }}
                                                    @if($isUserAnswer && !$isCorrectAnswer)
                                                        <i class="fas fa-times text-danger ms-1"></i>
                                                    @elseif($isCorrectAnswer)
                                                        <i class="fas fa-check text-success ms-1"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @elseif($question->type === 'true_false')
                                <div class="row mb-3">
                                    @php
                                        $isUserTrue = $userAnswer === 'True';
                                        $isUserFalse = $userAnswer === 'False';
                                        $isCorrectTrue = $question->correct_answer === 'True';
                                        $isCorrectFalse = $question->correct_answer === 'False';
                                    @endphp
                                    
                                    <div class="col-md-6">
                                        <div class="p-2 rounded {{ $isCorrectTrue ? 'bg-success bg-opacity-25' : ($isUserTrue ? 'bg-danger bg-opacity-25' : '') }}">
                                            <i class="fas fa-check me-1"></i>True
                                            @if($isUserTrue && !$isCorrectTrue)
                                                <i class="fas fa-times text-danger ms-1"></i>
                                            @elseif($isCorrectTrue)
                                                <i class="fas fa-check text-success ms-1"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 rounded {{ $isCorrectFalse ? 'bg-success bg-opacity-25' : ($isUserFalse ? 'bg-danger bg-opacity-25' : '') }}">
                                            <i class="fas fa-times me-1"></i>False
                                            @if($isUserFalse && !$isCorrectFalse)
                                                <i class="fas fa-times text-danger ms-1"></i>
                                            @elseif($isCorrectFalse)
                                                <i class="fas fa-check text-success ms-1"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mb-3">
                                    <div class="p-2 border rounded {{ $isCorrect ? 'border-success bg-success bg-opacity-10' : 'border-danger bg-danger bg-opacity-10' }}">
                                        <strong>Your Answer:</strong> {{ $userAnswer ?: 'No answer provided' }}
                                    </div>
                                </div>
                            @endif
                            
                            <div class="border-top pt-2">
                                <small class="text-success">
                                    <i class="fas fa-check me-1"></i>
                                    <strong>Correct Answer:</strong> {{ $question->correct_answer }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.circular-progress {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: conic-gradient(
        var(--primary-blue) calc(var(--percentage) * 1%),
        #e9ecef calc(var(--percentage) * 1%)
    );
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.circular-progress-inner {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.circular-progress .percentage {
    font-size: 18px;
    font-weight: bold;
    color: var(--primary-navy);
}

.circular-progress .grade {
    font-size: 14px;
    color: var(--primary-blue);
    font-weight: bold;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize circular progress animations
    document.querySelectorAll('.circular-progress').forEach(function(element) {
        const percentage = element.getAttribute('data-percentage');
        element.style.setProperty('--percentage', percentage);
    });
});
</script>

@endsection
