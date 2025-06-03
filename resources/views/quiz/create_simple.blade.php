@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Create New Quiz</h1>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Debug Information
        </div>
        <div class="card-body">
            <p><strong>User:</strong> {{ Auth::check() ? Auth::user()->name : 'Not logged in' }}</p>
            <p><strong>Role:</strong> {{ Auth::check() ? Auth::user()->role : 'None' }}</p>
            <p><strong>Can Manage Content:</strong> {{ Auth::check() && Auth::user()->canManageContent() ? 'Yes' : 'No' }}</p>
            <p><strong>Materials Count:</strong> {{ count($materials) }}</p>
        </div>
    </div>
    
    <div class="alert alert-info">
        <h4>Test Information:</h4>
        <p><strong>User:</strong> {{ Auth::user()->name ?? 'Not logged in' }}</p>
        <p><strong>Role:</strong> {{ Auth::user()->role ?? 'No role' }}</p>
        <p><strong>Materials Count:</strong> {{ isset($materials) ? count($materials) : 'Materials not passed' }}</p>
    </div>

    @if(isset($materials) && count($materials) > 0)
        <div class="alert alert-success">
            <h5>Available Materials:</h5>
            <ul>
                @foreach($materials as $material)
                    <li>{{ $material->subject->name ?? 'No Subject' }} - {{ $material->title }}</li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="alert alert-danger">
            <p>No materials available for creating quizzes.</p>
        </div>
    @endif

    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5>Quiz Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Quiz Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                
                <div class="mb-3">
                    <label for="material_id" class="form-label">Material</label>
                    <select class="form-select" id="material_id" name="material_id" required>
                        <option value="">Select Material</option>
                        @if(isset($materials))
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}">
                                    {{ $material->subject->name ?? 'No Subject' }} - {{ $material->title }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                        <input type="number" class="form-control" id="time_limit" name="time_limit" min="1">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="max_attempts" class="form-label">Maximum Attempts</label>
                        <input type="number" class="form-control" id="max_attempts" name="max_attempts" value="1" min="1" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Questions</h5>
                <button type="button" class="btn btn-primary btn-sm" onclick="addQuestion()">Add Question</button>
            </div>
            <div class="card-body">
                <div id="questions-container">
                    <!-- Questions will be added here -->
                </div>
                <div class="alert alert-info" id="no-questions-alert">
                    Click "Add Question" to start creating your quiz questions.
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Create Quiz</button>
            <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
let questionCount = 0;

function addQuestion() {
    questionCount++;
    
    const container = document.getElementById('questions-container');
    const noQuestionsAlert = document.getElementById('no-questions-alert');
    
    if (noQuestionsAlert) {
        noQuestionsAlert.style.display = 'none';
    }
    
    const questionHtml = `
        <div class="card mb-3 question-item" id="question-${questionCount}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Question ${questionCount}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeQuestion(${questionCount})">
                    Remove
                </button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <textarea class="form-control" name="questions[${questionCount}][question]" rows="2" required></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Question Type</label>
                        <select class="form-select" name="questions[${questionCount}][type]" onchange="updateQuestionOptions(${questionCount})" required>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="true_false">True/False</option>
                            <option value="text">Text Answer</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Points</label>
                        <input type="number" class="form-control" name="questions[${questionCount}][points]" value="1" min="1" required>
                    </div>
                </div>
                
                <div id="question-options-${questionCount}">
                    <!-- Options will be generated based on question type -->
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Correct Answer</label>
                    <input type="text" class="form-control" name="questions[${questionCount}][correct_answer]" required>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', questionHtml);
    updateQuestionOptions(questionCount);
}

function removeQuestion(questionId) {
    const questionElement = document.getElementById(`question-${questionId}`);
    if (questionElement) {
        questionElement.remove();
    }
    
    const remainingQuestions = document.querySelectorAll('.question-item');
    if (remainingQuestions.length === 0) {
        document.getElementById('no-questions-alert').style.display = 'block';
    }
}

function updateQuestionOptions(questionId) {
    const typeSelect = document.querySelector(`select[name="questions[${questionId}][type]"]`);
    const optionsContainer = document.getElementById(`question-options-${questionId}`);
    
    if (typeSelect.value === 'multiple_choice') {
        optionsContainer.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Answer Options (one per line)</label>
                <textarea class="form-control" name="questions[${questionId}][options]" rows="4" 
                          placeholder="Option A&#10;Option B&#10;Option C&#10;Option D"></textarea>
                <small class="text-muted">Enter the correct answer exactly as it appears in the options above</small>
            </div>
        `;
    } else if (typeSelect.value === 'true_false') {
        optionsContainer.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Answer Options</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tf_answer_${questionId}" value="True">
                    <label class="form-check-label">True</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tf_answer_${questionId}" value="False">
                    <label class="form-check-label">False</label>
                </div>
            </div>
        `;
    } else {
        optionsContainer.innerHTML = `
            <div class="alert alert-info">
                For text questions, enter the exact text answer students should provide.
            </div>
        `;
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    console.log('Quiz form loaded');
    // Add first question automatically
    setTimeout(function() {
        addQuestion();
    }, 100);
});
</script>
@endsection
