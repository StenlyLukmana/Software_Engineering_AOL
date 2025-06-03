@extends('layouts.main')

@section('container')
<style>
    .quiz-form-container {
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(12, 53, 106, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .card-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .card-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-navy) 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 1.25rem;
        border: none;
    }
    
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(1, 116, 190, 0.25);
    }
    
    .btn {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-navy) 100%);
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(1, 116, 190, 0.4);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
    }
    
    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }
    
    .question-item {
        background: linear-gradient(135deg, #fff 0%, #f8f9ff 100%);
        border: 2px solid #e9ecef;
        border-radius: 15px;
        transition: all 0.3s ease;
    }
    
    .question-item:hover {
        border-color: var(--primary-blue);
        box-shadow: 0 5px 20px rgba(1, 116, 190, 0.1);
    }
    
    .alert {
        border-radius: 12px;
        border: none;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--primary-navy);
        margin-bottom: 0.5rem;
    }
    
    .text-muted {
        color: #6c757d !important;
        font-size: 0.875rem;
    }
    
    .page-header-gradient {
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 50%, var(--accent-yellow) 100%);
        color: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .page-header-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }
    
    .question-counter {
        background: var(--accent-yellow);
        color: var(--primary-navy);
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.875rem;
    }
</style>

<div class="container-fluid">
    <!-- Enhanced Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header-gradient">
                <div class="position-relative">
                    <h1 class="mb-2 fw-bold">
                        <i class="fas fa-plus-circle me-3"></i>Create New Quiz
                    </h1>
                    <p class="mb-0 opacity-90 fs-5">Design an engaging and interactive quiz for your students</p>
                </div>
            </div>
        </div>
    </div>    <div class="quiz-form-container">
        <form action="{{ url('/quiz-store-direct') }}" method="POST" id="quiz-form">
            @csrf
            
            <!-- Quiz Details -->
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-1"></i>Quiz Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Quiz Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                           value="{{ old('title') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="material_id" class="form-label">Material *</label>
                                    <select class="form-select" id="material_id" name="material_id" required>
                                        <option value="">Select Material</option>
                                        @foreach($materials as $material)
                                            <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                                {{ $material->subject->name }} - {{ $material->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                                    <input type="number" class="form-control" id="time_limit" name="time_limit" 
                                           value="{{ old('time_limit') }}" min="1">
                                    <small class="text-muted">Leave empty for no time limit</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="max_attempts" class="form-label">Maximum Attempts *</label>
                                    <input type="number" class="form-control" id="max_attempts" name="max_attempts" 
                                           value="{{ old('max_attempts', 1) }}" min="1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Questions Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-custom">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-question-circle me-1"></i>Questions</h5>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addQuestion()">
                                <i class="fas fa-plus me-1"></i>Add Question
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="questions-container">
                                <!-- Questions will be added here dynamically -->
                            </div>
                            
                            <div class="alert alert-info" id="no-questions-alert">
                                <i class="fas fa-info-circle me-1"></i>
                                Click "Add Question" to start creating your quiz questions.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card card-custom">
                        <div class="card-body">                            <div class="d-flex justify-content-between">
                                <a href="{{ url('/quizzes') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i>Create Quiz
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
        <div class="question-item mb-4 p-4" id="question-${questionCount}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <div class="question-counter me-3">${questionCount}</div>
                    <h6 class="mb-0 text-primary">Question ${questionCount}</h6>
                </div>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeQuestion(${questionCount})" title="Remove Question">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-question-circle me-2"></i>Question Text *</label>
                <textarea class="form-control" name="questions[${questionCount}][question]" rows="3" required placeholder="Enter your question here..."></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fas fa-list me-2"></i>Question Type *</label>
                    <select class="form-select" name="questions[${questionCount}][type]" onchange="updateQuestionOptions(${questionCount})" required>
                        <option value="">Select Type</option>
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="true_false">True/False</option>
                        <option value="text">Text Answer</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fas fa-star me-2"></i>Points *</label>
                    <input type="number" class="form-control" name="questions[${questionCount}][points]" value="1" min="1" required>
                </div>
            </div>
            
            <div id="question-options-${questionCount}" class="mb-3">
                <!-- Options will be generated based on question type -->
            </div>
            
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-check me-2"></i>Correct Answer *</label>
                <input type="text" class="form-control" name="questions[${questionCount}][correct_answer]" required placeholder="Enter the correct answer">
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Enter the exact answer as it should match</small>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', questionHtml);
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
    
    if (!typeSelect || !optionsContainer) return;
    
    if (typeSelect.value === 'multiple_choice') {
        optionsContainer.innerHTML = `
            <div class="p-3 bg-light rounded">
                <label class="form-label"><i class="fas fa-list-ul me-2"></i>Answer Options (one per line)</label>
                <textarea class="form-control" name="questions[${questionId}][options]" rows="5" 
                          placeholder="A. First option&#10;B. Second option&#10;C. Third option&#10;D. Fourth option"></textarea>
                <small class="text-muted"><i class="fas fa-lightbulb me-1"></i>Tip: Enter the correct answer exactly as it appears in the options above</small>
            </div>
        `;
    } else if (typeSelect.value === 'true_false') {
        optionsContainer.innerHTML = `
            <div class="alert alert-info border-0" style="background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);">
                <i class="fas fa-info-circle me-2"></i>
                <strong>True/False Question:</strong> Enter "True" or "False" as the correct answer.
            </div>
        `;
    } else {
        optionsContainer.innerHTML = `
            <div class="alert alert-success border-0" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                <i class="fas fa-keyboard me-2"></i>
                <strong>Text Answer:</strong> Enter the exact text answer students should provide.
            </div>
        `;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Add first question automatically
    setTimeout(function() {
        addQuestion();
    }, 100);
});

// Form validation before submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('quiz-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const questions = document.querySelectorAll('.question-item');
            if (questions.length === 0) {
                e.preventDefault();
                alert('Please add at least one question to your quiz.');
                addQuestion();
                return false;
            }
            
            let isValid = true;
            questions.forEach((question, index) => {
                const questionText = question.querySelector('[name*="[question]"]');
                const correctAnswer = question.querySelector('[name*="[correct_answer]"]');
                
                if (!questionText.value.trim()) {
                    alert(`Please enter the question text for Question ${index + 1}`);
                    questionText.focus();
                    isValid = false;
                    return;
                }
                
                if (!correctAnswer.value.trim()) {
                    alert(`Please enter the correct answer for Question ${index + 1}`);
                    correctAnswer.focus();
                    isValid = false;
                    return;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
    }
});
</script>
@endsection
