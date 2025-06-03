@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 fw-bold">
                                <i class="fas fa-edit me-2"></i>Edit Subject
                            </h1>
                            <p class="mb-0 opacity-75">
                                Update the subject information
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('subjects.index') }}" class="btn btn-light btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Back to Subjects
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <i class="fas fa-edit me-2"></i>Subject Information
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('subjects.update', $subject) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">
                                <i class="fas fa-book me-1"></i>Subject Name
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $subject->name) }}" 
                                   required
                                   placeholder="Enter subject name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <small><i class="fas fa-info-circle me-1"></i>Choose a clear and descriptive name for the subject</small>
                            </div>
                        </div>

                        <!-- Subject Stats -->
                        <div class="mb-4">
                            <div class="card border-0" style="background: var(--light-cream);">
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-2" style="color: var(--primary-navy);">
                                        <i class="fas fa-chart-bar me-1"></i>Subject Statistics
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt me-2 text-primary"></i>
                                                <span><strong>{{ $subject->materials()->count() }}</strong> Learning Materials</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar me-2 text-success"></i>
                                                <span>Created {{ $subject->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancel
                            </a>
                            <div>
                                <a href="{{ route('subjects.materials', $subject->id) }}" class="btn btn-success-custom me-2">
                                    <i class="fas fa-eye me-1"></i>View Materials
                                </a>
                                <button type="submit" class="btn btn-primary-custom btn-lg">
                                    <i class="fas fa-save me-2"></i>Update Subject
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
