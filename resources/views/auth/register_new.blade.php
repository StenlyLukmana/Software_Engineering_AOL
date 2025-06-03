@extends('layouts.auth')

@section('title', 'Register - CS Learning Platform')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Join our Computer Science learning platform</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            
            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-user me-2"></i>Full Name
                </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope me-2"></i>Email Address
                </label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock me-2"></i>Password
                </label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">
                    <i class="fas fa-lock me-2"></i>Confirm Password
                </label>
                <input type="password" class="form-control" 
                       id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary auth-btn">
                <i class="fas fa-user-plus me-2"></i>Create Account
            </button>
        </form>
        
        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('login') }}" class="auth-link">Sign in here</a></p>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.auth-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    padding: 40px;
    width: 100%;
    max-width: 500px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.auth-header {
    text-align: center;
    margin-bottom: 30px;
}

.auth-title {
    color: var(--primary-navy);
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.auth-subtitle {
    color: var(--primary-blue);
    font-size: 1rem;
    margin-bottom: 0;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    color: var(--primary-navy);
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e1e5e9;
    border-radius: 10px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(1, 116, 190, 0.1);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
}

.auth-btn {
    width: 100%;
    padding: 12px 24px;
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-navy));
    border: none;
    border-radius: 10px;
    color: white;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.auth-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(1, 116, 190, 0.3);
}

.auth-footer {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #e1e5e9;
}

.auth-link {
    color: var(--primary-blue);
    text-decoration: none;
    font-weight: 600;
}

.auth-link:hover {
    color: var(--primary-navy);
    text-decoration: underline;
}

@media (max-width: 768px) {
    .auth-card {
        padding: 30px 20px;
        margin: 10px;
    }
    
    .auth-title {
        font-size: 1.5rem;
    }
}
</style>
@endsection
