@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Admin Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 fw-bold">
                                <i class="fas fa-shield-alt me-2"></i>Admin Dashboard
                            </h1>
                            <p class="mb-0 opacity-75">
                                Manage users, subjects, and platform content
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-none d-md-block">
                                <i class="fas fa-cog" style="font-size: 4rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-6 col-md-3 mb-4 mb-md-0">
            <div class="card card-custom h-100" style="background: var(--light-cream);">
                <div class="card-body text-center p-3 p-md-4">
                    <div class="mb-3">
                        <i class="fas fa-users" style="font-size: 2rem; color: var(--primary-navy);"></i>
                    </div>
                    <h3 class="fw-bold mb-1 fs-4" style="color: var(--primary-navy);">{{ $users }}</h3>
                    <p class="text-muted mb-0 small">Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-4 mb-md-0">
            <div class="card card-custom h-100" style="background: linear-gradient(45deg, var(--accent-yellow), #ffd700);">
                <div class="card-body text-center p-3 p-md-4">
                    <div class="mb-3">
                        <i class="fas fa-book-open" style="font-size: 2rem; color: var(--primary-navy);"></i>
                    </div>
                    <h3 class="fw-bold mb-1 fs-4" style="color: var(--primary-navy);">{{ $subjects }}</h3>
                    <p class="mb-0 small" style="color: var(--primary-navy);">Subjects</p>
                </div>
            </div>        </div>
        <div class="col-6 col-md-3 mb-4 mb-md-0">
            <div class="card card-custom h-100" style="background: var(--primary-blue); color: white;">
                <div class="card-body text-center p-3 p-md-4">
                    <div class="mb-3">
                        <i class="fas fa-file-alt" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="fw-bold mb-1 fs-4">{{ $materials }}</h3>
                    <p class="mb-0 opacity-75 small">Learning Materials</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-4 mb-md-0">
            <div class="card card-custom h-100" style="background: linear-gradient(45deg, #28a745, #20c997);">
                <div class="card-body text-center p-3 p-md-4">
                    <div class="mb-3">
                        <i class="fas fa-chart-line" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 class="fw-bold mb-1 fs-4 text-white">{{ number_format(($materials / max($subjects, 1)), 1) }}</h3>
                    <p class="mb-0 text-white opacity-75 small">Avg Materials/Subject</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <i class="fas fa-tools me-2"></i>Admin Quick Actions
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.users') }}" class="btn btn-success-custom btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-users me-2"></i>Manage Users
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-plus me-2"></i>Add User
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('subjects.index') }}" class="btn btn-success-custom btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-book me-2"></i>View Subjects
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary-custom btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-plus me-2"></i>New Subject
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    @if($recentUsers->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <i class="fas fa-clock me-2"></i>Recent Users
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>
                                        <i class="fas fa-user-circle me-2 text-muted"></i>{{ $user->name }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($user->role === 'admin') bg-danger
                                            @elseif($user->role === 'lecturer') bg-warning text-dark
                                            @else bg-info
                                            @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-right me-1"></i>View All Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
