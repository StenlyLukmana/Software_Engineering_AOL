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
                                <i class="fas fa-user-plus me-2"></i>Create New User
                            </h1>
                            <p class="mb-0 opacity-75">
                                Add a new user to the learning platform
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.users') }}" class="btn btn-light btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Back to Users
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
                    <i class="fas fa-user-plus me-2"></i>User Information
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-user me-1"></i>Full Name
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-bold">
                                    <i class="fas fa-envelope me-1"></i>Email Address
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-bold">
                                    <i class="fas fa-lock me-1"></i>Password
                                </label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required 
                                       minlength="8">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <small><i class="fas fa-info-circle me-1"></i>Minimum 8 characters required</small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label fw-bold">
                                    <i class="fas fa-user-tag me-1"></i>User Role
                                </label>
                                <select class="form-select @error('role') is-invalid @enderror" 
                                        id="role" 
                                        name="role" 
                                        required>
                                    <option value="">Select a role...</option>
                                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>
                                        <i class="fas fa-user-graduate"></i> Student
                                    </option>
                                    <option value="lecturer" {{ old('role') === 'lecturer' ? 'selected' : '' }}>
                                        <i class="fas fa-chalkboard-teacher"></i> Lecturer
                                    </option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                        <i class="fas fa-shield-alt"></i> Administrator
                                    </option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Role Descriptions -->
                        <div class="mb-4">
                            <div class="card border-0" style="background: var(--light-cream);">
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-2" style="color: var(--primary-navy);">
                                        <i class="fas fa-info-circle me-1"></i>Role Permissions
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong class="text-info">Student:</strong>
                                            <ul class="small mb-0">
                                                <li>View subjects and materials</li>
                                                <li>Access learning content</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <strong class="text-warning">Lecturer:</strong>
                                            <ul class="small mb-0">
                                                <li>All student permissions</li>
                                                <li>Create and edit subjects</li>
                                                <li>Manage learning materials</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <strong class="text-danger">Administrator:</strong>
                                            <ul class="small mb-0">
                                                <li>All lecturer permissions</li>
                                                <li>Manage users and roles</li>
                                                <li>Full system access</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
