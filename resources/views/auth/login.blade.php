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
        background: linear-gradient(135deg, var(--light-cream) 0%, #ffffff 50%, var(--primary-blue) 100%);
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
        background: radial-gradient(circle, rgba(255, 196, 54, 0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }
    
    .back-button {
        position: fixed;
        top: 2rem;
        left: 2rem;
        background: var(--primary-blue);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        text-decoration: none;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(1, 116, 190, 0.3);
        transition: all 0.3s ease;
        z-index: 1000;
        animation: slideInLeft 0.6s ease-out;
    }
    
    .back-button:hover {
        background: var(--primary-navy);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(1, 116, 190, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 30px;
        padding: 3rem;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 10;
        animation: slideInUp 0.8s ease-out;
    }
    
    .auth-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    
    .auth-icon {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-navy));
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        animation: bounceIn 1s ease-out 0.3s both;
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
        animation: fadeIn 0.8s ease-out 0.4s both;
    }
    
    .auth-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 0;
        animation: fadeIn 0.8s ease-out 0.5s both;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--primary-navy);
        margin-bottom: 0.5rem;
        display: block;
        font-size: 1rem;
    }
    
    .form-control {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(1, 116, 190, 0.1);
        transform: translateY(-2px);
    }
    
    .form-control:hover {
        border-color: var(--primary-blue);
        transform: translateY(-1px);
    }
    
    .btn-primary-custom {
        width: 100%;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-navy));
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-primary-custom:hover::before {
        left: 100%;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(1, 116, 190, 0.4);
    }
    
    .btn-primary-custom:active {
        transform: translateY(-1px);
        transition: transform 0.1s ease;
    }
    
    .auth-links {
        text-align: center;
        margin-top: 2rem;
        animation: fadeIn 1s ease-out 0.8s both;
    }
    
    .auth-links a {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        display: inline-block;
    }
    
    .auth-links a:hover {
        color: var(--primary-navy);
        background: rgba(1, 116, 190, 0.1);
        transform: translateY(-2px);
        text-decoration: none;
    }
    
    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: slideInLeft 0.6s ease-out 0.6s both;
    }
    
    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-blue);
        cursor: pointer;
    }
    
    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        padding: 0.5rem;
        background: rgba(220, 53, 69, 0.1);
        border-radius: 8px;
        border-left: 4px solid #dc3545;
    }
    
    .success-message {
        background: rgba(40, 167, 69, 0.1);
        border: 1px solid rgba(40, 167, 69, 0.2);
        border-left: 4px solid #28a745;
        color: #155724;
        padding: 0.75rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        text-align: center;
    }
    
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideInUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes slideInLeft {
        from { transform: translateX(-50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes bounceIn {
        0%, 20%, 40%, 60%, 80% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-10px) scale(1.05); }
        70% { transform: translateY(-5px) scale(1.02); }
        90% { transform: translateY(-2px) scale(1.01); }
        100% { transform: translateY(0) scale(1); }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .auth-container {
            padding: 1rem;
        }
        
        .auth-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .auth-title {
            font-size: 2rem;
        }
        
        .back-button {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 0.5rem 1rem;
        }
    }
    
    /* Accessibility */
    .form-control:focus,
    .btn-primary-custom:focus,
    .back-button:focus,
    .auth-links a:focus {
        outline: 2px solid var(--accent-yellow);
        outline-offset: 2px;
    }
</style>

<div class="auth-container">
    <a href="{{ url('/') }}" class="back-button">
        <i class="fas fa-arrow-left me-2"></i>Back to Home
    </a>
    
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <h1 class="auth-title">Welcome Back!</h1>
            <p class="auth-subtitle">Sign in to continue your computer science learning journey</p>
        </div>

        @if (session('status'))
            <div class="success-message">
                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope me-2"></i>Email Address
                </label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                       placeholder="Enter your email address">
                @error('email')
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock me-2"></i>Password
                </label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password" 
                       placeholder="Enter your password">
                @error('password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn-primary-custom">
                <i class="fas fa-sign-in-alt me-2"></i>Sign In
            </button>

            <div class="auth-links">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <i class="fas fa-key me-1"></i>Forgot your password?
                    </a>
                    <br><br>
                @endif
                
                @if (Route::has('register'))
                    <span>Don't have an account? </span>
                    <a href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i>Sign up here
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
