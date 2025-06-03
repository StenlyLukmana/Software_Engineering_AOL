@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Navigation Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('subjects.index') }}" style="color: var(--primary-blue);">
                        <i class="fas fa-home me-1"></i>Subjects
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('subjects.materials', $material->subject_id) }}" style="color: var(--primary-blue);">
                        {{ $material->subject->name }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $material->title }}</li>
            </ol>
        </nav>

        <!-- Material Header -->
        <div class="card card-custom mb-4" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h1 class="mb-2 fw-bold">
                            <i class="fas fa-file-alt me-2"></i>{{ $material->title }}
                        </h1>
                        <p class="mb-2 opacity-75">
                            <i class="fas fa-book me-2"></i>{{ $material->subject->name }}
                        </p>
                        <div class="d-flex align-items-center">
                            <small class="opacity-75 me-3">
                                <i class="fas fa-calendar me-1"></i>Added: {{ $material->created_at->format('M d, Y') }}
                            </small>
                            @if($material->media)
                                @php
                                    $extension = pathinfo($material->media, PATHINFO_EXTENSION);
                                    $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']);
                                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                @endphp
                                <span class="badge bg-light text-dark">
                                    @if($isVideo)
                                        <i class="fas fa-play-circle me-1"></i>Video Content
                                    @elseif($isImage)
                                        <i class="fas fa-image me-1"></i>Image Content
                                    @else
                                        <i class="fas fa-file me-1"></i>File Attachment
                                    @endif
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('subjects.materials', $material->subject_id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to Materials
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Media Content (if exists) -->
            @if($material->media)
                <div class="col-lg-12 mb-4">
                    <div class="card card-custom">
                        <div class="card-header" style="background: var(--light-cream); color: var(--primary-navy); font-weight: 600;">
                            <i class="fas fa-media me-2"></i>Media Content
                        </div>
                        <div class="card-body text-center p-4">
                            @php
                                $mediaPath = 'storage/media/' . $material->media;
                                $extension = pathinfo($material->media, PATHINFO_EXTENSION);
                                $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']);
                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                            @endphp

                            @if($isImage)
                                <div class="media-container mb-3">
                                    <img 
                                        src="{{ asset($mediaPath) }}" 
                                        alt="{{ $material->title }}" 
                                        class="img-fluid rounded shadow"
                                        style="max-height: 500px; border-radius: 15px !important;"
                                    >
                                </div>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-info-circle me-1"></i>Click image to view in full size
                                </p>
                            @elseif($isVideo)
                                <div class="media-container mb-3">
                                    <video 
                                        controls 
                                        class="w-100 rounded shadow" 
                                        style="max-height: 500px; border-radius: 15px !important;"
                                    >
                                        <source src="{{ asset($mediaPath) }}" type="video/{{ $extension }}">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-info-circle me-1"></i>Use video controls to play, pause, and adjust volume
                                </p>
                            @else
                                <div class="text-center py-4">
                                    <div class="mb-3">
                                        <i class="fas fa-file-download" style="font-size: 3rem; color: var(--primary-blue);"></i>
                                    </div>
                                    <h5 style="color: var(--primary-navy);">File Attachment</h5>
                                    <p class="text-muted mb-3">{{ $material->media }}</p>
                                    <a href="{{ asset($mediaPath) }}" class="btn btn-primary-custom" download>
                                        <i class="fas fa-download me-2"></i>Download File
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Text Content -->
            <div class="col-lg-12">
                <div class="card card-custom">
                    <div class="card-header" style="background: var(--light-cream); color: var(--primary-navy); font-weight: 600;">
                        <i class="fas fa-align-left me-2"></i>Content Description
                    </div>
                    <div class="card-body p-4">
                        <div class="content-text" style="line-height: 1.8; font-size: 1.1rem; color: #333;">
                            {!! nl2br(e($material->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <a href="{{ route('subjects.materials', $material->subject_id) }}" class="btn btn-success-custom btn-lg me-3">
                <i class="fas fa-list me-2"></i>View All Materials
            </a>
            <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-book me-2"></i>Browse Subjects
            </a>
        </div>
    </div>
</div>

<style>
    .media-container img {
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    
    .media-container img:hover {
        transform: scale(1.02);
    }
    
    .content-text {
        background: rgba(255, 240, 206, 0.1);
        padding: 2rem;
        border-radius: 10px;
        border-left: 4px solid var(--primary-blue);
    }
</style>

@endsection
