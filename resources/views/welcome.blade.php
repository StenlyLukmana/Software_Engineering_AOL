<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Learning Platform - Learn Computer Science, One Bit at a Time</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #0C356A;
            --primary-blue: #0174BE;
            --accent-yellow: #FFC436;
            --light-cream: #FFF0CE;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', Arial, Helvetica, sans-serif;
        }        .index-body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.6s;
            padding: 20px 50px;
            z-index: 100000;
        }

        @media (min-width: 992px) {
            header {
                padding-left: 100px;
                padding-right: 100px;
            }
        }

        @media (min-width: 1200px) {
            header {
                padding-left: 200px;
                padding-right: 200px;
            }
        }

        header.sticky {
            padding: 15px 50px;
            background: var(--light-cream);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        header div a {
            position: relative;
            margin: 0 25px;
            text-decoration: none;
            color: var(--primary-navy);
            letter-spacing: 2px;
            font-weight: 700;
            transition: 0.5s;
            font-size: 1.4rem;
        }

        header div a:hover {
            opacity: 0.7;
            color: var(--primary-blue);
        }

        .logo-img {
            width: 150px;
        }        .home-container {
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(to bottom right, var(--light-cream), var(--accent-yellow));
            display: flex;
            align-items: center;
            overflow: hidden;
            position: relative;
            padding: 0 20px;
        }
        
        @media (min-width: 768px) {
            .home-container {
                padding: 0 50px;
            }
        }
        
        @media (min-width: 992px) {
            .home-container {
                padding: 0 100px;
                height: 100vh;
            }
        }        .content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            gap: 40px;
            padding: 100px 0 50px;
        }
        
        @media (min-width: 992px) {
            .content-wrapper {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                gap: 60px;
                padding: 0;
                max-width: 1400px;
                margin: 0 auto;
            }
        }        .background-content {
            position: relative;
            z-index: 1;
            text-align: center;
            flex: 1 1 auto;
            min-width: 0;
        }
        
        @media (min-width: 992px) {
            .background-content {
                padding-left: 50px;
                text-align: left;
                flex: 1 1 45%;
                min-width: 400px;
            }
        }

        .background-content h1 {
            color: var(--primary-navy);
            font-size: 1.8rem;
            font-family: 'Press Start 2P', monospace;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        
        @media (min-width: 768px) {
            .background-content h1 {
                font-size: 2.2rem;
            }
        }
        
        @media (min-width: 992px) {
            .background-content h1 {
                font-size: 2.6rem;
            }
        }

        .background-content h3 {
            color: var(--primary-navy);
            font-size: 1rem;
            font-weight: 450;
        }
        
        @media (min-width: 768px) {
            .background-content h3 {
                font-size: 1.2rem;
            }
        }
        
        @media (min-width: 992px) {
            .background-content h3 {
                font-size: 1.4rem;
            }
        }        .pixel-art-img {
            max-width: 300px;
            width: 100%;
            height: auto;
            object-fit: contain;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: -moz-crisp-edges;
            image-rendering: crisp-edges;
            image-rendering: pixelated;
            flex-shrink: 0;
        }
        
        @media (min-width: 768px) {
            .pixel-art-img {
                max-width: 400px;
            }
        }
        
        @media (min-width: 992px) {
            .pixel-art-img {
                flex: 0 0 auto;
                width: auto;
                max-width: 550px;
                min-width: 450px;
                height: auto;
            }
        }.login-button {
            cursor: pointer;
            color: var(--primary-navy);
            font-size: 1.2rem;
            text-decoration: none;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-align: center;
        }
        
        @media (min-width: 768px) {
            .login-button {
                font-size: 1.5rem;
            }
        }
        
        @media (min-width: 992px) {
            .login-button {
                font-size: 1.8rem;
                font-weight: 1000;
            }
        }

        .sign-button-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            max-width: 100%;
            overflow: hidden;
        }

        .sign-button {
            display: inline-block;
            padding: 10px 20px;
        }
        
        @media (min-width: 768px) {
            .sign-button {
                padding: 12px 25px;
            }
        }
        
        @media (min-width: 992px) {
            .sign-button {
                padding: 15px 30px;
            }
        }
            background-color: var(--primary-blue);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: var(--light-cream);
            font-size: 1.8rem;
            text-decoration: none;
            font-weight: 450;
            white-space: nowrap;
            overflow: hidden;
            text-align: center;
            transition: 0.5s;
        }

        .sign-button:hover {
            background-color: var(--primary-navy);
        }

        .start-button{
            display: inline-block;
            padding: 15px 50px;
            background-color: var(--primary-blue);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: var(--light-cream);
            font-size: 1.8rem;
            text-decoration: none;
            font-weight: 450;
            white-space: nowrap;
            overflow: hidden;
            text-align: center;
            transition: all 0.3s ease;
            border: 3px solid var(--primary-navy);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .start-button-container{
           padding-top: 20px;
        }

        .start-button:hover {
            background-color: var(--primary-navy);
            transform: translateY(-2px);
        }

        .overview-header{
            color: var(--light-cream);
            font-size: 2rem;
            font-family: 'Press Start 2P', monospace;
            padding: 0px 250px;
            padding-top: 100px;
            background-color: var(--primary-navy);
        }        .overview-container {
            width: 100%;
            min-height: 100vh;
            background-color: var(--primary-navy);
            display: flex;
            overflow: hidden;
            position: relative;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            padding-top: 40px;
            padding-bottom: 100px;
        }

        /* Footer Styles */
        .footer {
            background-color: var(--primary-navy);
            padding: 60px 0 30px 0;
            border-top: 4px solid var(--accent-yellow);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .footer-section h3 {
            color: var(--accent-yellow);
            font-family: 'Press Start 2P', monospace;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .footer-section p,
        .footer-section a {
            color: var(--light-cream);
            text-decoration: none;
            line-height: 1.6;
            margin-bottom: 10px;
            display: block;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--accent-yellow);
        }

        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: var(--primary-blue);
            border-radius: 50%;
            color: var(--light-cream);
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background-color: var(--accent-yellow);
            color: var(--primary-navy);
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid var(--primary-blue);
            margin-top: 40px;
            padding-top: 20px;
            text-align: center;
            color: var(--light-cream);
        }

        .footer-bottom p {
            margin: 0;
            font-size: 0.9rem;
        }

        .card {
            width: 325px;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: var(--light-cream);
            overflow: hidden;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            margin: 20px;
            outline: 1px solid var(--primary-navy);
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.4);
            background-color: var(--accent-yellow);
        }

        .card-content {
            padding: 16px;
        }

        .card-content h3 {
            color: var(--primary-navy);
            font-weight: 300;
        }

        .card-content h1 {
            color: var(--primary-navy);
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary-navy);
            font-family: 'Press Start 2P', monospace;
            font-size: 1.5rem;
            padding: 10px;
        }        @media screen and (max-width: 768px) {
            header {
                padding: 15px 20px;
                flex-direction: column;
                align-items: flex-start;
            }

            .home-container {
                padding: 0 20px;
                height: auto;
                min-height: 100vh;
            }

            .content-wrapper {
                flex-direction: column;
                gap: 40px;
                padding-top: 100px;
            }

            .background-content {
                padding-left: 0;
                text-align: center;
                order: 1;
            }

            .background-content h1 {
                font-size: 1.8rem;
                line-height: 1.3;
            }

            .background-content h3 {
                font-size: 1.1rem;
                line-height: 1.4;
            }

            .pixel-art-img {
                max-width: 300px;
                order: 2;
                margin: 0 auto;
            }

            .overview-header {
                padding: 20px;
                font-size: 1.5rem;
                text-align: center;
            }

            .overview-container {
                padding: 20px;
            }

            .card {
                width: 100%;
                max-width: 350px;
                margin: 10px auto;
            }

            .nav {
                flex-direction: column;
                gap: 15px;
                width: 100%;
                margin-top: 20px;
            }

            .sign-button-container {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 480px) {
            .background-content h1 {
                font-size: 1.4rem;
            }

            .background-content h3 {
                font-size: 1rem;
            }

            .pixel-art-img {
                max-width: 250px;
            }

            .start-button {
                font-size: 1.4rem;
                padding: 12px 40px;
            }

            .sign-button {
                font-size: 1.4rem;
                padding: 12px 25px;
            }

            .login-button {
                font-size: 1.4rem;
            }

            .overview-header {
                font-size: 1.2rem;
                padding: 15px;
            }

            .card {
                margin: 10px 5px;
                width: calc(100% - 10px);
            }

            .card-content h1 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body class="index-body">
    <div class="home-container">
        <div class="overlay">
            <header id="navbar">
                <a href="{{ url('/') }}" class="logo">
                    <img class="logo-img" src="{{ asset('images/B-removebg-preview.png') }}" alt="CS Learning Logo">
                </a>
                <div class="nav">
                    @guest
                        <a href="{{ route('login') }}" class="login-button">Login</a>
                        <div class="sign-button-container">
                            <a href="{{ route('register') }}" class="sign-button">Sign Up</a>
                        </div>
                    @else
                        <a href="{{ route('dashboard') }}" class="login-button">Dashboard</a>
                        <div class="sign-button-container">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="sign-button" style="border: none; background: inherit; font-family: inherit;">Logout</button>
                            </form>
                        </div>
                    @endguest
                </div>
            </header>
            
            <div class="content-wrapper">
                <div class="background-content">
                    <h1>Learn Computer Science,</h1>
                    <h1>One Bit at a Time</h1>
                    <h3>Whether you're curious, committed, or just starting,</h3>
                    <h3>our platform gives you beginner-friendly lessons — no experience needed.</h3>
                    <div class="start-button-container">
                        @guest
                            <a href="{{ route('register') }}" class="start-button">Get Started</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="start-button">Go to Dashboard</a>
                        @endguest
                    </div>
                </div>
                <img src="{{ asset('images/home_pixel_art.png') }}" alt="Pixel Art" class="pixel-art-img" />  
            </div>
        </div>
    </div>

    <h1 class="overview-header">Start Small, Learn Big!</h1>

    <div class="overview-container">
        <div class="card">
            <div class="card-content">
                <h1><i class="fas fa-database me-2" style="color: var(--primary-blue);"></i>Database Systems</h1>
                <h3>Master the fundamentals of database design, SQL queries, and data management. Learn how to structure, store, and retrieve information efficiently.</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <h1><i class="fas fa-code me-2" style="color: var(--accent-yellow);"></i>Algorithm & Programming</h1>
                <h3>Develop problem-solving skills with algorithmic thinking and programming fundamentals. Build the foundation for computational thinking.</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <h1><i class="fas fa-project-diagram me-2" style="color: var(--primary-navy);"></i>Data Structures</h1>
                <h3>Explore essential data structures like arrays, linked lists, trees, and graphs. Understand how to organize and manipulate data effectively.</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <h1><i class="fas fa-network-wired me-2" style="color: var(--primary-blue);"></i>Computer Networks</h1>
                <h3>Understand how computers communicate and share information across networks. Learn about protocols, security, and network architecture.</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <h1><i class="fas fa-tools me-2" style="color: var(--accent-yellow);"></i>Software Engineering</h1>
                <h3>Learn systematic approaches to software development, including design patterns, testing methodologies, and project management principles.</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <h1><i class="fas fa-server me-2" style="color: var(--primary-navy);"></i>Operating Systems</h1>
                <h3>Dive into the core of computer systems. Understand how operating systems manage hardware resources and provide services to applications.</h3>
            </div>        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About CS Learning</h3>
                <p>Empowering students to master computer science fundamentals through interactive learning and practical applications.</p>
                <p>Our mission is to make computer science education accessible and engaging for everyone, regardless of their background.</p>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                @guest
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Sign Up</a>
                @else
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @endguest
                <a href="{{ url('/') }}">Home</a>
                <a href="#courses">Courses</a>
            </div>
            
            <div class="footer-section">
                <h3>Subjects</h3>
                <a href="#">Database Systems</a>
                <a href="#">Algorithm & Programming</a>
                <a href="#">Data Structures</a>
                <a href="#">Computer Networks</a>
                <a href="#">Software Engineering</a>
                <a href="#">Operating Systems</a>
            </div>
            
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <p>Follow us on social media for updates and tips!</p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024 CS Learning Platform. All rights reserved. Made with ❤️ for computer science students.</p>
        </div>
    </footer>

    <script>
        window.addEventListener("scroll", function () {
            const navbar = document.getElementById("navbar");
            navbar.classList.toggle("sticky", window.scrollY > 50);
        });
        
        // Add smooth scrolling and enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Card hover effects
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
</body>
</html>
