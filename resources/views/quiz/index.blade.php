@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 fw-bold">
                                <i class="fas fa-clipboard-check me-2"></i>Quizzes
                            </h1>
                            <p class="mb-0 opacity-75">
                                Test your knowledge and track your progress
                            </p>
                        </div>                        <div class="col-md-4 text-end">
                            @if(auth()->user()->canManageContent())
                                <a href="{{ url('/quiz-create-direct') }}" class="btn btn-light btn-sm">
                                    <i class="fas fa-plus me-1"></i>Create Quiz
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quizzes Grid -->
    <div class="row">
        @forelse($quizzes as $quiz)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-custom h-100">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold text-primary">
                                {{ $quiz->material->subject->name }}
                            </h6>
                            @if(!$quiz->is_active)
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $quiz->title }}</h5>
                        @if($quiz->description)
                            <p class="card-text text-muted small">{{ Str::limit($quiz->description, 100) }}</p>
                        @endif
                        
                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <div class="text-primary">
                                    <i class="fas fa-question-circle fa-lg"></i>
                                    <div class="small mt-1">{{ $quiz->questions->count() }} Questions</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-info">
                                    <i class="fas fa-clock fa-lg"></i>
                                    <div class="small mt-1">
                                        {{ $quiz->time_limit ? $quiz->time_limit . ' min' : 'No limit' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-warning">
                                    <i class="fas fa-redo fa-lg"></i>
                                    <div class="small mt-1">{{ $quiz->max_attempts }} Attempts</div>
                                </div>
                            </div>
                        </div>

                        @if(!auth()->user()->canManageContent())
                            @php
                                $userAttempts = $quiz->userAttempts(auth()->id())->count();
                                $bestScore = $quiz->getUserBestScore(auth()->id());
                                $totalPoints = $quiz->getTotalPoints();
                                $percentage = $totalPoints > 0 ? ($bestScore / $totalPoints) * 100 : 0;
                            @endphp
                            
                            @if($bestScore > 0)
                                <div class="text-center mb-3">
                                    <div class="circular-progress mx-auto" data-percentage="{{ $percentage }}">
                                        <div class="circular-progress-inner">
                                            <span class="percentage">{{ round($percentage) }}%</span>
                                            <small class="grade">
                                                @php
                                                    if ($percentage >= 97) echo 'A+';
                                                    elseif ($percentage >= 93) echo 'A';
                                                    elseif ($percentage >= 90) echo 'A-';
                                                    elseif ($percentage >= 87) echo 'B+';
                                                    elseif ($percentage >= 83) echo 'B';
                                                    elseif ($percentage >= 80) echo 'B-';
                                                    elseif ($percentage >= 77) echo 'C+';
                                                    elseif ($percentage >= 73) echo 'C';
                                                    elseif ($percentage >= 70) echo 'C-';
                                                    elseif ($percentage >= 67) echo 'D+';
                                                    elseif ($percentage >= 65) echo 'D';
                                                    else echo 'F';
                                                @endphp
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Material: {{ $quiz->material->title }}
                            </small>
                            <div>
                                @if(auth()->user()->canManageContent())
                                    <a href="{{ route('quiz.edit', $quiz) }}" class="btn btn-outline-primary btn-sm me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                <a href="{{ route('quiz.show', $quiz) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-clipboard-check fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No Quizzes Available</h4>
                        <p class="text-muted">There are no quizzes available at this time.</p>                        @if(auth()->user()->canManageContent())
                            <a href="{{ url('/quiz-create-direct') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Create First Quiz
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
.circular-progress {
    width: 80px;
    height: 80px;
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
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.circular-progress .percentage {
    font-size: 12px;
    font-weight: bold;
    color: var(--primary-navy);
}

.circular-progress .grade {
    font-size: 10px;
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
