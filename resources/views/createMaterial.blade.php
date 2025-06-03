@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Header -->
        <div class="text-center mb-4">
            <h2 style="color: var(--primary-navy); font-weight: 700;">
                <i class="fas fa-plus-circle me-2"></i>Add Learning Material
            </h2>
            <p class="text-muted">Create new educational content for <strong>{{ $subject->name }}</strong></p>
        </div>

        <!-- Navigation Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('subjects.index') }}" style="color: var(--primary-blue);">
                        <i class="fas fa-home me-1"></i>Subjects
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('subjects.materials', $subject->id) }}" style="color: var(--primary-blue);">
                        {{ $subject->name }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add Material</li>
            </ol>
        </nav>

        <div class="card card-custom">
            <div class="card-header card-header-custom text-center">
                <i class="fas fa-file-plus me-2"></i>Material Details
            </div>
            <div class="card-body p-4">
                <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">

                    <!-- Title Field -->
                    <div class="mb-4">
                        <label for="material_title" class="form-label fw-bold" style="color: var(--primary-navy);">
                            <i class="fas fa-heading me-2"></i>Material Title
                        </label>
                        <input 
                            name="title" 
                            type="text" 
                            class="form-control form-control-lg" 
                            id="material_title" 
                            placeholder="Enter a descriptive title for the material" 
                            required
                            style="border-radius: 10px; border: 2px solid var(--light-cream); transition: all 0.3s ease;"
                            onfocus="this.style.borderColor='var(--primary-blue)'"
                            onblur="this.style.borderColor='var(--light-cream)'"
                        >
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle me-1"></i>Choose a clear, descriptive title (e.g., "Introduction to SQL Queries")
                        </small>
                    </div>

                    <!-- Content Field -->
                    <div class="mb-4">
                        <label for="material_content" class="form-label fw-bold" style="color: var(--primary-navy);">
                            <i class="fas fa-align-left me-2"></i>Content Description
                        </label>
                        <textarea 
                            name="content" 
                            class="form-control" 
                            id="material_content" 
                            rows="6"
                            placeholder="Provide a detailed description of the learning material content..."
                            required
                            style="border-radius: 10px; border: 2px solid var(--light-cream); transition: all 0.3s ease; resize: vertical;"
                            onfocus="this.style.borderColor='var(--primary-blue)'"
                            onblur="this.style.borderColor='var(--light-cream)'"
                        ></textarea>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle me-1"></i>Explain what students will learn from this material
                        </small>
                    </div>

                    <!-- Media Upload Field -->
                    <div class="mb-4">
                        <label for="material_media" class="form-label fw-bold" style="color: var(--primary-navy);">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Media File (Optional)
                        </label>
                        <input 
                            name="media" 
                            type="file" 
                            class="form-control form-control-lg" 
                            id="material_media"
                            accept="image/*,video/*,.pdf,.doc,.docx,.ppt,.pptx"
                            style="border-radius: 10px; border: 2px solid var(--light-cream); transition: all 0.3s ease;"
                            onfocus="this.style.borderColor='var(--primary-blue)'"
                            onblur="this.style.borderColor='var(--light-cream)'"
                        >
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle me-1"></i>Supported formats: Images, Videos, PDF, Word docs, PowerPoint
                        </small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-save me-2"></i>Create Material
                        </button>
                        <a href="{{ route('subjects.materials', $subject->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to {{ $subject->name }}
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Helpful Information Card -->
        <div class="card card-custom mt-4" style="background: var(--light-cream);">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--primary-navy);">
                    <i class="fas fa-lightbulb me-2"></i>Material Creation Tips
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>Use clear, educational titles
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>Provide comprehensive descriptions
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check text-success me-2"></i>Include relevant media when possible
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>Focus on learning objectives
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>Structure content logically
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check text-success me-2"></i>Consider student skill level
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection