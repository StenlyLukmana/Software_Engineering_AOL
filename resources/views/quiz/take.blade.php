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
                            <h1 class="mb-1 fw-bold">{{ $quiz->title }}</h1>
                            <p class="mb-0 opacity-75">
                                {{ $quiz->material->subject->name }} - {{ $quiz->material->title }}
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            @if($timeRemaining)
                                <div class="bg-white bg-opacity-25 rounded p-3">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-clock fa-lg me-2"></i>
                                        <div>
                                            <div class="fw-bold" id="time-remaining">{{ $timeRemaining }}:00</div>
                                            <small>Time Remaining</small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('quiz.submit', [$quiz, $attempt]) }}" method="POST" id="quiz-form">
        @csrf
        
        <!-- Questions -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @foreach($quiz->questions as $index => $question)
                    <div class="card card-custom mb-4">
                        <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold">
                                    Question {{ $index + 1 }} of {{ $quiz->questions->count() }}
                                </h6>
                                <span class="badge bg-primary">{{ $question->points }} {{ $question->points == 1 ? 'point' : 'points' }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">{{ $question->question }}</h6>
                            
                            @if($question->type === 'multiple_choice')
                                @if($question->options)
                                    <div class="row">
                                        @foreach($question->options as $optIndex => $option)
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" 
                                                           name="answers[{{ $question->id }}]" 
                                                           value="{{ chr(65 + $optIndex) }}" 
                                                           id="q{{ $question->id }}_{{ $optIndex }}">
                                                    <label class="form-check-label" for="q{{ $question->id }}_{{ $optIndex }}">
                                                        <span class="badge bg-light text-dark me-2">{{ chr(65 + $optIndex) }}</span>
                                                        {{ $option }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @elseif($question->type === 'true_false')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="answers[{{ $question->id }}]" 
                                                   value="True" 
                                                   id="q{{ $question->id }}_true">
                                            <label class="form-check-label" for="q{{ $question->id }}_true">
                                                <i class="fas fa-check text-success me-1"></i>True
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="answers[{{ $question->id }}]" 
                                                   value="False" 
                                                   id="q{{ $question->id }}_false">
                                            <label class="form-check-label" for="q{{ $question->id }}_false">
                                                <i class="fas fa-times text-danger me-1"></i>False
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mb-3">
                                    <textarea class="form-control" name="answers[{{ $question->id }}]" 
                                              rows="3" placeholder="Enter your answer here..."></textarea>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Submit Section -->
                <div class="card card-custom">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-check me-2"></i>Submit Quiz
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('quiz.show', $quiz) }}" class="btn btn-outline-secondary btn-lg w-100"
                                   onclick="return confirm('Are you sure you want to leave? Your progress will be lost.')">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Make sure to review your answers before submitting. You cannot change them afterwards.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Progress Indicator -->
    <div class="fixed-bottom p-3" style="z-index: 1040;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-clipboard-check me-1"></i>
                                    Progress: <span id="answered-count">0</span>/{{ $quiz->questions->count() }} answered
                                </small>
                                <div class="progress" style="width: 200px; height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" id="progress-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let totalQuestions = {{ $quiz->questions->count() }};
@if($timeRemaining)
let timeRemaining = {{ $timeRemaining * 60 }}; // Convert to seconds

// Timer functionality
function updateTimer() {
    if (timeRemaining <= 0) {
        document.getElementById('quiz-form').submit();
        return;
    }
    
    let minutes = Math.floor(timeRemaining / 60);
    let seconds = timeRemaining % 60;
    
    document.getElementById('time-remaining').textContent = 
        minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    
    timeRemaining--;
}

// Start timer
setInterval(updateTimer, 1000);
@endif

// Progress tracking
function updateProgress() {
    let answeredCount = 0;
    
    // Count answered questions
    document.querySelectorAll('input[type="radio"]:checked, textarea').forEach(function(input) {
        if (input.type === 'radio' && input.checked) {
            answeredCount++;
        } else if (input.tagName === 'TEXTAREA' && input.value.trim() !== '') {
            answeredCount++;
        }
    });
    
    // Remove duplicates for radio buttons (same question)
    let radioGroups = {};
    document.querySelectorAll('input[type="radio"]:checked').forEach(function(input) {
        radioGroups[input.name] = true;
    });
    
    let textAnswers = 0;
    document.querySelectorAll('textarea').forEach(function(textarea) {
        if (textarea.value.trim() !== '') {
            textAnswers++;
        }
    });
    
    answeredCount = Object.keys(radioGroups).length + textAnswers;
    
    document.getElementById('answered-count').textContent = answeredCount;
    
    let percentage = (answeredCount / totalQuestions) * 100;
    document.getElementById('progress-bar').style.width = percentage + '%';
}

// Attach event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Track radio button changes
    document.querySelectorAll('input[type="radio"]').forEach(function(input) {
        input.addEventListener('change', updateProgress);
    });
    
    // Track textarea changes
    document.querySelectorAll('textarea').forEach(function(textarea) {
        textarea.addEventListener('input', updateProgress);
    });
    
    // Initial progress update
    updateProgress();
});

// Prevent accidental navigation away
window.addEventListener('beforeunload', function (e) {
    e.preventDefault();
    e.returnValue = '';
});

// Remove beforeunload when submitting
document.getElementById('quiz-form').addEventListener('submit', function() {
    window.removeEventListener('beforeunload', function() {});
});
</script>

@endsection
