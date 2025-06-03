<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CS Learning Platform' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        :root {
            --primary-navy: #0C356A;
            --primary-blue: #0174BE;
            --accent-yellow: #FFC436;
            --light-cream: #FFF0CE;
            --navy-rgb: rgb(12, 53, 106);
            --blue-rgb: rgb(1, 116, 190);
            --yellow-rgb: rgb(255, 196, 54);
            --cream-rgb: rgb(255, 240, 206);
        }
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, var(--light-cream) 0%, #ffffff 100%);
            min-height: 100vh;
        }
        
        .navbar-custom {
            background: linear-gradient(90deg, var(--primary-navy) 0%, var(--primary-blue) 100%);
            box-shadow: 0 4px 15px rgba(12, 53, 106, 0.2);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 25px;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .btn-primary-custom {
            background: linear-gradient(45deg, var(--accent-yellow), #ffd700);
            border: none;
            color: var(--primary-navy);
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 196, 54, 0.4);
            background: linear-gradient(45deg, #ffd700, var(--accent-yellow));
        }
        
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(12, 53, 106, 0.1);
            transition: all 0.3s ease;
            background: white;
        }
        
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(12, 53, 106, 0.15);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .btn-success-custom {
            background: linear-gradient(45deg, var(--primary-blue), var(--primary-navy));
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        
        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(1, 116, 190, 0.3);
            background: linear-gradient(45deg, var(--primary-navy), var(--primary-blue));
        }
        
        .table-custom {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table-custom thead th {
            background: var(--light-cream);
            color: var(--primary-navy);
            border: none;
            font-weight: 600;
            padding: 1rem;
        }
        
        .table-custom tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-custom tbody tr:hover {
            background: rgba(255, 240, 206, 0.3);
            transform: scale(1.01);
        }
        
        .container-custom {
            padding: 2rem 0;
        }
        
        .role-badge {
            background: var(--accent-yellow);
            color: var(--primary-navy);
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-graduation-cap me-2"></i>CS Learning Platform
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('subjects.index') }}">
                                <i class="fas fa-book me-1"></i>Subjects
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('quiz.index') }}">
                                <i class="fas fa-clipboard-check me-1"></i>Quizzes
                            </a>
                        </li>
                        @if(auth()->user()->canManageContent())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-plus-circle me-1"></i>Create
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('subjects.create') }}">
                                        <i class="fas fa-book me-2"></i>New Subject</a></li>
                                    <li><a class="dropdown-item" href="{{ route('quiz.create') }}">
                                        <i class="fas fa-clipboard-check me-2"></i>New Quiz</a></li>
                                </ul>
                            </li>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-shield-alt me-1"></i>Admin
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.users') }}">
                                        <i class="fas fa-users me-2"></i>Manage Users</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.users.create') }}">
                                        <i class="fas fa-user-plus me-2"></i>Add User</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <span class="role-badge me-3">{{ ucfirst(auth()->user()->role) }}</span>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-primary-custom me-2">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container container-custom">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @yield('container')
    </div>

    <script>
        // Add smooth scrolling and enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth transitions for cards
            const cards = document.querySelectorAll('.card-custom');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>