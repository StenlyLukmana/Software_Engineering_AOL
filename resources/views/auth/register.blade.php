@extends('layouts.auth')

@section('content')
<style>
    :root {
        --primary-navy: #0C356A;
        --primary-blue: #0174BE;
        --accent-yellow: #FFC436;
        --light-cream: #FFF0CE;
    }
    
    .auth-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--accent-yellow) 0%, var(--light-cream) 50%, var(--primary-blue) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        animation: fadeIn 0.8s ease-out;
    }

    .auth-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        animation: float 20s ease-in-out infinite;
        pointer-events: none;
    }

    .back-button {
        position: absolute;
        top: 2rem;
        left: 2rem;
        background: rgba(255, 255, 255, 0.9);
        color: var(--primary-navy);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        z-index: 10;
        animation: slideInLeft 0.6s ease-out;
    }

    .back-button:hover {
        background: white;
        color: var(--primary-blue);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 30px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        position: relative;
        animation: bounceIn 0.8s ease-out;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-navy));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        animation: bounceIn 0.8s ease-out 0.3s both;
        box-shadow: 0 10px 30px rgba(1, 116, 190, 0.3);
    }

    .auth-icon i {
        font-size: 2rem;
        color: white;
    }

    .auth-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 0.5rem;
        animation: slideInUp 0.6s ease-out 0.4s both;
    }

    .auth-subtitle {
        color: var(--primary-blue);
        font-size: 1.1rem;
        font-weight: 500;
        animation: fadeIn 0.8s ease-out 0.5s both;
    }

    .form-group {
        margin-bottom: 1.5rem;
        animation: slideInUp 0.6s ease-out 0.6s both;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--primary-navy);
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid transparent;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
        font-weight: 500;
        color: var(--primary-navy);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-blue);
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 0 0 4px rgba(1, 116, 190, 0.1);
        transform: translateY(-2px);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background: rgba(220, 53, 69, 0.05);
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-weight: 500;
        animation: shake 0.5s ease-in-out;
    }

    .btn-primary-custom {
        width: 100%;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-navy));
        color: white;
        border: none;
        border-radius: 15px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin: 1.5rem 0;
        position: relative;
        overflow: hidden;
        animation: slideInUp 0.6s ease-out 0.8s both;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(1, 116, 190, 0.3);
    }

    .btn-primary-custom:active {
        transform: translateY(0);
    }

    .auth-links {
        text-align: center;
        margin-top: 1.5rem;
        color: var(--primary-navy);
        font-weight: 500;
        animation: fadeIn 0.8s ease-out 1s both;
    }

    .auth-links a {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .auth-links a:hover {
        color: var(--primary-navy);
        text-decoration: underline;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-20px) rotate(1deg); }
        66% { transform: translateY(20px) rotate(-1deg); }
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    @media (max-width: 768px) {
        .auth-container {
            padding: 1rem;
        }
        
        .auth-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .auth-title {
            font-size: 2rem;
        }
        
        .back-button {
            top: 1rem;
            left: 1rem;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>

<div class="auth-container">
    <a href="{{ route('landing') }}" class="back-button">
        <i class="fas fa-arrow-left me-2"></i>Back to Home
    </a>
    
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Join our learning platform today</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-user me-2"></i>Full Name
                    </label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus 
                           placeholder="Enter your full name">
                    @error('name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Email Address
                    </label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" 
                           placeholder="Enter your email">
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="new-password" 
                           placeholder="Enter your password">
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock me-2"></i>Confirm Password
                    </label>
                    <input id="password_confirmation" type="password" class="form-control" 
                           name="password_confirmation" required autocomplete="new-password" 
                           placeholder="Confirm your password">
                </div>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">
                    <i class="fas fa-user-tag me-2"></i>Select Your Role
                </label>
                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                    <option value="">Select your role...</option>
                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>
                        Student - Access learning materials and courses
                    </option>
                    <option value="lecturer" {{ old('role') === 'lecturer' ? 'selected' : '' }}>
                        Lecturer - Create and manage educational content
                    </option>
                </select>
                @error('role')
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-primary-custom">
                <i class="fas fa-user-plus me-2"></i>Create Account
            </button>

            <div class="auth-links">
                <span>Already have an account? </span>
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt me-1"></i>Sign in here
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
