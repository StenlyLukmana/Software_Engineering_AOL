@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="text-center mb-4">
            <h2 style="color: var(--primary-navy); font-weight: 700;">
                <i class="fas fa-plus-circle me-2"></i>Create New Subject
            </h2>
            <p class="text-muted">Add a new computer science subject to the platform</p>
        </div>

        <div class="card card-custom">
            <div class="card-header card-header-custom text-center">
                <i class="fas fa-book me-2"></i>Subject Information
            </div>
            <div class="card-body p-4">
                <form action="{{ route('subjects.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="subject_name" class="form-label fw-bold" style="color: var(--primary-navy);">
                            <i class="fas fa-tag me-2"></i>Subject Name
                        </label>
                        <input 
                            name="name" 
                            type="text" 
                            class="form-control form-control-lg" 
                            id="subject_name" 
                            placeholder="Enter subject name (e.g., Database Systems)" 
                            required
                            style="border-radius: 10px; border: 2px solid var(--light-cream); transition: all 0.3s ease;"
                            onfocus="this.style.borderColor='var(--primary-blue)'"
                            onblur="this.style.borderColor='var(--light-cream)'"
                        >
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle me-1"></i>Choose a clear, descriptive name for the subject
                        </small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-save me-2"></i>Create Subject
                        </button>
                        <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Subjects
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Helpful Information Card -->
        <div class="card card-custom mt-4" style="background: var(--light-cream);">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--primary-navy);">
                    <i class="fas fa-lightbulb me-2"></i>Subject Creation Tips
                </h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>Use clear, academic subject names
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>Focus on computer science topics
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-check text-success me-2"></i>Consider organizing by complexity level
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection