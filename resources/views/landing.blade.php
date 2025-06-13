<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Learning - Learn Computer Science, One Bit at a Time</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-navy': '#0C356A',
                        'primary-blue': '#0174BE', 
                        'accent-yellow': '#FFC436',
                        'light-cream': '#FFF0CE'
                    },
                    fontFamily: {
                        'pixel': ['Press Start 2P', 'monospace'],
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }
        
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        @keyframes glow {
            0%, 100% {
                text-shadow: 0 0 5px rgba(255, 196, 54, 0.5);
            }
            50% {
                text-shadow: 0 0 20px rgba(255, 196, 54, 0.8), 0 0 30px rgba(255, 196, 54, 0.6);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .animate-fadeInLeft {
            animation: fadeInLeft 0.8s ease-out;
        }
        
        .animate-fadeInRight {
            animation: fadeInRight 0.8s ease-out;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-glow {
            animation: glow 2s ease-in-out infinite;
        }
        
        .delay-200 { animation-delay: 0.2s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-600 { animation-delay: 0.6s; }
        .delay-800 { animation-delay: 0.8s; }
        
        /* Glassmorphism effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(45deg, #0174BE, #0C356A);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Sticky header with smooth transition */
        .header-sticky {
            backdrop-filter: blur(20px);
            background: rgba(255, 240, 206, 0.95);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
          /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #0174BE;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #0C356A;
        }
        
        /* Performance optimizations */
        * {
            box-sizing: border-box;
        }
        
        .animate-fadeInUp,
        .animate-fadeInLeft,
        .animate-fadeInRight,
        .animate-float {
            will-change: transform, opacity;
        }
        
        /* Smooth scrolling for entire page */
        html {
            scroll-behavior: smooth;
        }
          /* Responsive adjustments */
        @media (max-width: 768px) {
            .pixel-art-img {
                max-width: 300px !important;
            }
            
            .hero-title {
                font-size: 1.5rem !important;
            }
            
            .hero-subtitle {
                font-size: 1rem !important;
            }
        }
          /* Improved image display */
        .pixel-art-img {
            max-width: 500px;
            width: 100%;
            height: auto;
            object-fit: contain;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
            image-rendering: pixelated;
            filter: drop-shadow(0 10px 30px rgba(12, 53, 106, 0.2));
            transition: all 0.3s ease;
        }
        
        .pixel-art-img:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 15px 40px rgba(12, 53, 106, 0.3));
        }
        
        @media (min-width: 1024px) {
            .pixel-art-img {
                max-width: 600px;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-light-cream to-white">
    <!-- Enhanced Header -->
    <header id="header" class="fixed top-0 left-0 w-full z-50 transition-all duration-500 px-4 md:px-8 lg:px-16 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-3 animate-fadeInLeft">
                <img src="{{ asset('images/B-removebg-preview.png') }}" alt="CS Learning Logo" class="h-12 w-12">
                <span class="text-2xl font-bold gradient-text font-pixel">CS Learning</span>
            </div>
            
            <!-- Navigation Buttons -->
            <div class="flex items-center space-x-3 animate-fadeInRight">
                <a href="{{ route('login') }}" 
                   class="px-6 py-2 text-primary-navy font-semibold hover:text-primary-blue transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
                <a href="{{ route('register') }}" 
                   class="px-6 py-2 bg-primary-blue text-white rounded-full font-semibold hover:bg-primary-navy transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>Sign Up
                </a>
            </div>
        </div>
    </header>

    <!-- Enhanced Hero Section -->
    <section class="min-h-screen flex items-center justify-center px-4 md:px-8 lg:px-16 pt-20">
        <div class="max-w-7xl mx-auto w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Content Side -->
                <div class="text-left space-y-6 animate-fadeInLeft">
                    <div class="space-y-4">
                        <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl font-pixel text-primary-navy leading-tight animate-glow">
                            Learn Computer Science
                        </h1>
                        <p class="hero-subtitle text-xl md:text-2xl text-primary-navy font-medium">
                            One Bit at a Time
                        </p>
                        <p class="text-lg text-gray-600 leading-relaxed max-w-lg">
                            Master the fundamentals of computer science with our comprehensive learning platform. 
                            From algorithms to databases, we've got you covered.
                        </p>
                    </div>
                    
                    <!-- Enhanced CTA Button -->
                    <div class="pt-4">
                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary-blue to-primary-navy text-white font-bold text-lg rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 group">
                            <i class="fas fa-rocket mr-3"></i>
                            Get Started Now 
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                    
                    <!-- Stats Section -->
                    <div class="grid grid-cols-3 gap-6 pt-8 animate-fadeInUp delay-400">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-navy">12+</div>
                            <div class="text-sm text-gray-600">Subjects</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-navy">50+</div>
                            <div class="text-sm text-gray-600">Lessons</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-navy">24/7</div>
                            <div class="text-sm text-gray-600">Access</div>
                        </div>
                    </div>
                </div>
                  <!-- Image Side -->
                <div class="flex justify-center lg:justify-end animate-fadeInRight delay-200">
                    <img src="{{ asset('images/home_pixel_art.png') }}" 
                         alt="Learning Illustration" 
                         class="pixel-art-img animate-float">
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Overview Section -->
    <section class="py-20 bg-primary-navy">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
            <!-- Section Header -->
            <div class="text-center mb-16 animate-fadeInUp">
                <h2 class="text-4xl md:text-5xl font-pixel text-light-cream mb-6 animate-glow">
                    What You'll Learn
                </h2>
                <p class="text-xl text-light-cream/80 max-w-3xl mx-auto">
                    Dive deep into core computer science concepts with our expertly crafted curriculum
                </p>
            </div>
            
            <!-- Subject Cards -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">                <!-- Database Systems -->
                <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 animate-fadeInUp delay-200">
                    <div class="text-primary-blue text-4xl mb-4">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-navy mb-4">Database Systems</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Master SQL, database design, normalization, and modern database technologies. 
                        Learn to build efficient and scalable data storage solutions.
                    </p>
                    <a href="{{ route('course.detail', 'database-systems') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-primary-blue text-white rounded-lg hover:bg-primary-navy transition-colors duration-300 no-underline">
                        <span>Explore Course</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                  <!-- Algorithm & Programming -->
                <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 animate-fadeInUp delay-400">
                    <div class="text-primary-blue text-4xl mb-4">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-navy mb-4">Algorithm & Programming</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Learn fundamental programming concepts, algorithm design, and problem-solving techniques. 
                        Build strong coding foundations across multiple languages.
                    </p>
                    <a href="{{ route('course.detail', 'algorithm-programming') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-primary-blue text-white rounded-lg hover:bg-primary-navy transition-colors duration-300 no-underline">
                        <span>Explore Course</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                  <!-- Data Structures -->
                <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 animate-fadeInUp delay-600">
                    <div class="text-primary-blue text-4xl mb-4">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-navy mb-4">Data Structures</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Understand arrays, linked lists, trees, graphs, and hash tables. 
                        Learn when and how to use the right data structure for optimal performance.
                    </p>
                    <a href="{{ route('course.detail', 'data-structures') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-primary-blue text-white rounded-lg hover:bg-primary-navy transition-colors duration-300 no-underline">
                        <span>Explore Course</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                  <!-- Computer Networks -->
                <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 animate-fadeInUp delay-200">
                    <div class="text-primary-blue text-4xl mb-4">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-navy mb-4">Computer Networks</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Explore network protocols, architecture, security, and distributed systems. 
                        Understand how modern internet infrastructure works.
                    </p>
                    <a href="{{ route('course.detail', 'computer-networks') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-primary-blue text-white rounded-lg hover:bg-primary-navy transition-colors duration-300 no-underline">
                        <span>Explore Course</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                  <!-- Software Engineering -->
                <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 animate-fadeInUp delay-400">
                    <div class="text-primary-blue text-4xl mb-4">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-navy mb-4">Software Engineering</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Learn software development lifecycle, design patterns, testing methodologies, 
                        and project management for building robust applications.
                    </p>
                    <a href="{{ route('course.detail', 'software-engineering') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-primary-blue text-white rounded-lg hover:bg-primary-navy transition-colors duration-300 no-underline">
                        <span>Explore Course</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                  <!-- Operating Systems -->
                <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 animate-fadeInUp delay-600">
                    <div class="text-primary-blue text-4xl mb-4">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-navy mb-4">Operating Systems</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Understand process management, memory allocation, file systems, and system calls. 
                        Learn how operating systems manage computer resources.
                    </p>
                    <a href="{{ route('course.detail', 'operating-systems') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-primary-blue text-white rounded-lg hover:bg-primary-navy transition-colors duration-300 no-underline">
                        <span>Explore Course</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced CTA Section -->
    <section class="py-20 bg-gradient-to-r from-light-cream to-accent-yellow">
        <div class="max-w-4xl mx-auto text-center px-4 md:px-8">
            <div class="animate-fadeInUp">
                <h2 class="text-4xl md:text-5xl font-bold text-primary-navy mb-6">
                    Ready to Start Your Journey?
                </h2>
                <p class="text-xl text-primary-navy/80 mb-8 max-w-2xl mx-auto">
                    Join thousands of students already learning computer science with our platform. 
                    Your future in tech starts here.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}" 
                       class="px-8 py-4 bg-primary-blue text-white font-bold text-lg rounded-full shadow-xl hover:bg-primary-navy transition-all duration-300 transform hover:scale-105 hover:-translate-y-2">
                        <i class="fas fa-graduation-cap mr-3"></i>Start Learning Today
                    </a>
                    <a href="{{ route('login') }}" 
                       class="px-8 py-4 border-2 border-primary-navy text-primary-navy font-bold text-lg rounded-full hover:bg-primary-navy hover:text-white transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-3"></i>Already Have Account?
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="bg-primary-navy text-light-cream py-12">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
            <div class="grid md:grid-cols-3 gap-8 text-center md:text-left">
                <div class="animate-fadeInLeft">
                    <div class="flex items-center justify-center md:justify-start space-x-3 mb-4">
                        <img src="{{ asset('images/B-removebg-preview.png') }}" alt="CS Learning Logo" class="h-10 w-10">
                        <span class="text-2xl font-bold font-pixel">CS Learning</span>
                    </div>
                    <p class="text-light-cream/80">
                        Empowering the next generation of computer scientists with quality education and hands-on learning.
                    </p>
                </div>
                
                <div class="animate-fadeInUp delay-200">
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('register') }}" class="text-light-cream/80 hover:text-accent-yellow transition-colors duration-300">Get Started</a></li>
                        <li><a href="{{ route('login') }}" class="text-light-cream/80 hover:text-accent-yellow transition-colors duration-300">Login</a></li>
                        <li><a href="#" class="text-light-cream/80 hover:text-accent-yellow transition-colors duration-300">About Us</a></li>
                        <li><a href="#" class="text-light-cream/80 hover:text-accent-yellow transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>
                
                <div class="animate-fadeInRight delay-400">
                    <h3 class="text-xl font-bold mb-4">Connect With Us</h3>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <a href="#" class="text-2xl text-light-cream/80 hover:text-accent-yellow transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-2xl text-light-cream/80 hover:text-accent-yellow transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-2xl text-light-cream/80 hover:text-accent-yellow transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-2xl text-light-cream/80 hover:text-accent-yellow transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-light-cream/20 mt-8 pt-8 text-center">
                <p class="text-light-cream/60">
                    © 2025 CS Learning Platform. All rights reserved. Made with <i class="fas fa-heart text-accent-yellow"></i> for computer science education.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for enhanced interactions -->
    <script>
        // Sticky header effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('header-sticky');
            } else {
                header.classList.remove('header-sticky');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animation
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            setTimeout(() => {
                document.body.style.transition = 'opacity 0.5s ease';
                document.body.style.opacity = '1';
            }, 100);
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.animate-fadeInUp, .animate-fadeInLeft, .animate-fadeInRight').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            observer.observe(el);    
    </script>
</body>
</html>
