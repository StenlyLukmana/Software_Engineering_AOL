@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Quiz Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center mb-2">
                                <a href="{{ route('quiz.index') }}" class="btn btn-outline-light btn-sm me-3">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                                <div>
                                    <h1 class="mb-1 fw-bold">{{ $quiz->title }}</h1>
                                    <p class="mb-0 opacity-75">
                                        {{ $quiz->material->subject->name }} - {{ $quiz->material->title }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            @if(auth()->user()->canManageContent())
                                <div class="btn-group">
                                    <a href="{{ route('quiz.edit', $quiz) }}" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('quiz.destroy', $quiz) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this quiz?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quiz Information -->
        <div class="col-lg-8">
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-1"></i>Quiz Information</h5>
                </div>
                <div class="card-body">
                    @if($quiz->description)
                        <p class="mb-3">{{ $quiz->description }}</p>
                    @endif
                    
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="bg-light rounded p-3">
                                <i class="fas fa-question-circle fa-2x text-primary mb-2"></i>
                                <h6 class="mb-0">{{ $quiz->questions->count() }}</h6>
                                <small class="text-muted">Questions</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="bg-light rounded p-3">
                                <i class="fas fa-clock fa-2x text-info mb-2"></i>
                                <h6 class="mb-0">{{ $quiz->time_limit ?? 'No' }}</h6>
                                <small class="text-muted">{{ $quiz->time_limit ? 'Minutes' : 'Time Limit' }}</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="bg-light rounded p-3">
                                <i class="fas fa-redo fa-2x text-warning mb-2"></i>
                                <h6 class="mb-0">{{ $quiz->max_attempts }}</h6>
                                <small class="text-muted">Max Attempts</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="bg-light rounded p-3">
                                <i class="fas fa-star fa-2x text-success mb-2"></i>
                                <h6 class="mb-0">{{ $totalPoints }}</h6>
                                <small class="text-muted">Total Points</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quiz Questions Preview (for instructors) -->
            @if(auth()->user()->canManageContent())
                <div class="card card-custom">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-list me-1"></i>Questions Preview</h5>
                    </div>
                    <div class="card-body">
                        @foreach($quiz->questions as $index => $question)
                            <div class="border rounded p-3 mb-3">
                                <h6 class="fw-bold">Question {{ $index + 1 }} ({{ $question->points }} points)</h6>
                                <p class="mb-2">{{ $question->question }}</p>
                                
                                @if($question->type === 'multiple_choice' && $question->options)
                                    <div class="row">
                                        @foreach($question->options as $optIndex => $option)
                                            <div class="col-md-6 mb-1">
                                                <span class="badge bg-light text-dark me-1">{{ chr(65 + $optIndex) }}</span>
                                                {{ $option }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <div class="mt-2">
                                    <small class="text-success">
                                        <i class="fas fa-check me-1"></i>
                                        Correct Answer: {{ $question->correct_answer }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Student Actions & Progress -->
        <div class="col-lg-4">
            @if(!auth()->user()->canManageContent())
                <!-- Student Progress -->
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-line me-1"></i>Your Progress</h5>
                    </div>
                    <div class="card-body text-center">
                        @if($bestScore > 0)
                            @php
                                $percentage = ($bestScore / $totalPoints) * 100;
                                $letterGrade = '';
                                if ($percentage >= 97) $letterGrade = 'A+';
                                elseif ($percentage >= 93) $letterGrade = 'A';
                                elseif ($percentage >= 90) $letterGrade = 'A-';
                                elseif ($percentage >= 87) $letterGrade = 'B+';
                                elseif ($percentage >= 83) $letterGrade = 'B';
                                elseif ($percentage >= 80) $letterGrade = 'B-';
                                elseif ($percentage >= 77) $letterGrade = 'C+';
                                elseif ($percentage >= 73) $letterGrade = 'C';
                                elseif ($percentage >= 70) $letterGrade = 'C-';
                                elseif ($percentage >= 67) $letterGrade = 'D+';
                                elseif ($percentage >= 65) $letterGrade = 'D';
                                else $letterGrade = 'F';
                            @endphp
                            
                            <div class="circular-progress mx-auto mb-3" data-percentage="{{ $percentage }}">
                                <div class="circular-progress-inner">
                                    <span class="percentage">{{ round($percentage) }}%</span>
                                    <small class="grade">{{ $letterGrade }}</small>
                                </div>
                            </div>
                            
                            <h6 class="text-success">Best Score: {{ $bestScore }}/{{ $totalPoints }}</h6>
                            <p class="text-muted small mb-0">
                                Attempts: {{ $attempts->count() }}/{{ $quiz->max_attempts }}
                            </p>
                        @else
                            <i class="fas fa-clipboard-check fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Not Attempted Yet</h6>
                            <p class="text-muted small">Take your first quiz attempt</p>
                        @endif
                    </div>
                </div>

                <!-- Take Quiz Action -->
                <div class="card card-custom">
                    <div class="card-body text-center">
                        @if($canTakeQuiz)
                            <form action="{{ route('quiz.start', $quiz) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-play me-2"></i>
                                    {{ $attempts->count() > 0 ? 'Retake Quiz' : 'Start Quiz' }}
                                </button>
                            </form>
                            
                            @if($quiz->time_limit)
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $quiz->time_limit }} minutes time limit
                                </small>
                            @endif
                        @else
                            <button class="btn btn-secondary btn-lg w-100" disabled>
                                <i class="fas fa-ban me-2"></i>
                                Maximum Attempts Reached
                            </button>
                            <small class="text-muted d-block mt-2">
                                You have used all {{ $quiz->max_attempts }} attempts
                            </small>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Attempt History -->
            @if($attempts->count() > 0)
                <div class="card card-custom mt-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-history me-1"></i>Attempt History</h5>
                    </div>
                    <div class="card-body">
                        @foreach($attempts as $index => $attempt)
                            <div class="d-flex justify-content-between align-items-center mb-2 {{ !$loop->last ? 'border-bottom pb-2' : '' }}">
                                <div>
                                    <small class="text-muted">Attempt {{ $attempts->count() - $index }}</small>
                                    <div>{{ $attempt->created_at->format('M j, Y g:i A') }}</div>
                                </div>
                                <div class="text-end">
                                    @if($attempt->isCompleted())
                                        <div class="fw-bold text-primary">
                                            {{ $attempt->score }}/{{ $attempt->total_points }}
                                        </div>
                                        <small class="text-muted">{{ $attempt->getLetterGrade() }}</small>
                                    @else
                                        <span class="badge bg-warning">In Progress</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
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
