@extends('layouts.main')

@section('container')
<style>
    :root {
        --primary-navy: #0C356A;
        --primary-blue: #0174BE;
        --accent-yellow: #FFC436;
        --light-cream: #FFF0CE;
    }
    
    .profile-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--light-cream) 0%, #ffffff 100%);
        padding: 2rem;
        animation: fadeIn 0.6s ease-out;
    }
    
    .profile-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: slideDown 0.8s ease-out;
    }
    
    .profile-title {
        color: var(--primary-navy);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    
    .profile-subtitle {
        color: #666;
        font-size: 1.1rem;
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
        box-shadow: 0 6px 20px rgba(12, 53, 106, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .profile-cards-container {
        max-width: 800px;
        margin: 0 auto;
        display: grid;
        gap: 2rem;
        animation: slideUp 1s ease-out;
    }
    
    .profile-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(12, 53, 106, 0.1);
        padding: 2.5rem;
        border: 2px solid var(--light-cream);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue), var(--accent-yellow));
    }
    
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(12, 53, 106, 0.15);
    }
    
    .card-title {
        color: var(--primary-navy);
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .card-description {
        color: #666;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        color: var(--primary-navy);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--light-cream);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fafafa;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(1, 116, 190, 0.1);
        background: white;
        transform: scale(1.02);
    }
    
    .btn-primary-custom {
        background: linear-gradient(45deg, var(--primary-blue), var(--primary-navy));
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(1, 116, 190, 0.3);
    }
    
    .btn-danger-custom {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-danger-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
    }
    
    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        animation: shake 0.5s ease-out;
    }
    
    .success-message {
        background: #d4edda;
        color: #155724;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        border: 1px solid #c3e6cb;
        animation: slideDown 0.5s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideDown {
        from { transform: translateY(-30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes slideInLeft {
        from { transform: translateX(-100px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    @media (max-width: 768px) {
        .profile-container {
            padding: 1rem;
        }
        
        .profile-title {
            font-size: 2rem;
        }
        
        .profile-card {
            padding: 1.5rem;
        }
        
        .back-button {
            position: relative;
            top: auto;
            left: auto;
            margin-bottom: 1rem;
            display: inline-block;
        }
    }
    
    /* Performance optimizations */
    .profile-card,
    .back-button {
        will-change: transform, opacity;
    }
    
    /* Accessibility improvements */
    .form-control:focus {
        outline: 2px solid var(--primary-blue);
        outline-offset: 2px;
    }
    
    .btn-primary-custom:focus,
    .btn-danger-custom:focus {
        outline: 2px solid var(--accent-yellow);
        outline-offset: 2px;
    }
</style>

<div class="profile-container">
    <a href="{{ route('dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
    </a>
    
    <div class="profile-header">
        <h1 class="profile-title">
            <i class="fas fa-user-circle me-3"></i>Profile Settings
        </h1>
        <p class="profile-subtitle">Manage your account information and security settings</p>
    </div>
    
    <div class="profile-cards-container">
        <!-- Profile Information Card -->
        <div class="profile-card">
            <h2 class="card-title">
                <i class="fas fa-user-edit"></i>
                Profile Information
            </h2>
            <p class="card-description">Update your account's profile information and email address.</p>
            
            @if (session('status') === 'profile-updated')
                <div class="success-message">
                    <i class="fas fa-check-circle me-2"></i>Profile updated successfully!
                </div>
            @endif
            
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning">
                        Your email address is unverified.
                        <button form="send-verification" class="btn btn-link">Click here to re-send the verification email.</button>
                    </div>
                @endif
                
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Save Changes
                </button>
            </form>
        </div>
        
        <!-- Update Password Card -->
        <div class="profile-card">
            <h2 class="card-title">
                <i class="fas fa-lock"></i>
                Update Password
            </h2>
            <p class="card-description">Ensure your account is using a long, random password to stay secure.</p>
            
            @if (session('status') === 'password-updated')
                <div class="success-message">
                    <i class="fas fa-check-circle me-2"></i>Password updated successfully!
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                
                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                    @error('current_password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-key me-2"></i>Update Password
                </button>
            </form>
        </div>
        
        <!-- Delete Account Card -->
        <div class="profile-card">
            <h2 class="card-title">
                <i class="fas fa-trash-alt text-danger"></i>
                Delete Account
            </h2>
            <p class="card-description">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
            
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                @csrf
                @method('delete')
                
                <div class="form-group">
                    <label for="password_delete" class="form-label">Password</label>
                    <input id="password_delete" name="password" type="password" class="form-control" placeholder="Enter your password to confirm deletion">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-danger-custom">
                    <i class="fas fa-exclamation-triangle me-2"></i>Delete Account
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
