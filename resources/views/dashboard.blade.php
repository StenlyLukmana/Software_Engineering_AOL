@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 fw-bold">
                                <i class="fas fa-graduation-cap me-2"></i>Welcome back, {{ auth()->user()->name }}!
                            </h1>
                            <p class="mb-0 opacity-75">
                                Ready to continue your computer science learning journey?
                            </p>
                            <span class="badge bg-light text-dark mt-2 px-3 py-2">
                                <i class="fas fa-user-tag me-1"></i>{{ ucfirst(auth()->user()->role) }} Account
                            </span>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-none d-md-block">
                                <i class="fas fa-laptop-code" style="font-size: 4rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card card-custom h-100" style="background: var(--light-cream);">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-book-open" style="font-size: 2.5rem; color: var(--primary-navy);"></i>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: var(--primary-navy);">{{ App\Models\Subject::count() }}</h3>
                    <p class="text-muted mb-0">Available Subjects</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom h-100" style="background: linear-gradient(45deg, var(--accent-yellow), #ffd700);">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-file-alt" style="font-size: 2.5rem; color: var(--primary-navy);"></i>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: var(--primary-navy);">{{ App\Models\Material::count() }}</h3>
                    <p class="mb-0" style="color: var(--primary-navy);">Learning Materials</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom h-100" style="background: var(--primary-blue); color: white;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-users" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ App\Models\User::count() }}</h3>
                    <p class="mb-0 opacity-75">Platform Users</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('subjects.index') }}" class="btn btn-success-custom btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-book-open me-2"></i>Browse Subjects
                            </a>
                        </div>
                        @if(auth()->user()->canManageContent())
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('subjects.create') }}" class="btn btn-primary-custom btn-lg w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-plus me-2"></i>New Subject
                                </a>
                            </div>
                        @endif
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-cog me-2"></i>Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Subjects -->
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-clock me-2"></i>Recent Subjects</span>
                    <a href="{{ route('subjects.index') }}" class="btn btn-light btn-sm">View All</a>
                </div>
                <div class="card-body p-0">
                    @php
                        $recentSubjects = App\Models\Subject::with('materials')->latest()->take(5)->get();
                    @endphp
                    @if($recentSubjects->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentSubjects as $subject)
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="subject-icon me-3" style="background: var(--light-cream); width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-code" style="color: var(--primary-navy);"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1 fw-bold" style="color: var(--primary-navy);">{{ $subject->name }}</h6>
                                            <small class="text-muted">{{ $subject->materials->count() }} materials available</small>
                                        </div>
                                    </div>
                                    <a href="{{ route('subjects.materials', $subject->id) }}" class="btn btn-success-custom btn-sm">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-book-open" style="font-size: 3rem; color: var(--light-cream);"></i>
                            </div>
                            <h5 style="color: var(--primary-navy);">No Subjects Available</h5>
                            <p class="text-muted">Start your learning journey by exploring available subjects.</p>
                            @if(auth()->user()->canManageContent())
                                <a href="{{ route('subjects.create') }}" class="btn btn-primary-custom">
                                    <i class="fas fa-plus me-2"></i>Create First Subject
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
