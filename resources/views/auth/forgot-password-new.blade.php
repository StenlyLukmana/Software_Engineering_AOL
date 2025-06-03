<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CS Learning Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-navy: #1e3a8a;
            --primary-blue: #3b82f6;
            --accent-gold: #f59e0b;
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-navy) 0%, #1e40af 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .reset-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .reset-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .reset-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-gold));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin: 0 auto 2rem;
        }
        
        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }
        
        .btn-reset {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-navy));
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
            color: white;
        }
        
        .btn-secondary {
            background: #6b7280;
            border: none;
            border-radius: 12px;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: #4b5563;
            color: white;
            text-decoration: none;
        }
        
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border-left: 4px solid #16a34a;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }
        
        .text-muted {
            color: #6b7280 !important;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .step-indicator {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .step {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
        }

        .step-number {
            width: 24px;
            height: 24px;
            background: var(--primary-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            margin-right: 0.75rem;
        }

        .password-toggle {
            border: none;
            background: transparent;
            color: #6b7280;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .input-group {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-card">
            <div class="text-center">
                <div class="reset-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Reset Password</h2>
                <p class="text-muted mb-4">
                    Enter your username and email to reset your password directly.
                </p>
            </div>

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step">
                    <div class="step-number">1</div>
                    <span class="text-sm">Enter your username and email</span>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <span class="text-sm">Set your new password</span>
                </div>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.reset.local') }}">
                @csrf

                <!-- Username -->
                <div class="mb-3">
                    <label for="name" class="form-label">
                        <i class="fas fa-user me-2"></i>Username
                    </label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           placeholder="Enter your username">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Email Address
                    </label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required
                           placeholder="Enter your email address">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>New Password
                    </label>
                    <div class="input-group">
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required
                               placeholder="Enter your new password">
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-toggle"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock me-2"></i>Confirm New Password
                    </label>
                    <div class="input-group">
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               placeholder="Confirm your new password">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye" id="password_confirmation-toggle"></i>
                        </button>
                    </div>
                </div>

                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-reset">
                        <i class="fas fa-shield-alt me-2"></i>
                        Reset Password
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = document.getElementById(fieldId + '-toggle');
            
            if (field.type === 'password') {
                field.type = 'text';
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
