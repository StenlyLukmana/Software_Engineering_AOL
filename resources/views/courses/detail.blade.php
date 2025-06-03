@extends('layouts.main')

@section('container')
<style>    .course-header {
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);
        color: white;
        border-radius: 20px;
        padding: 3rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: visible;
    }
    
    .course-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
        z-index: 1;
    }
    
    .difficulty-stars {
        display: inline-flex;
        align-items: center;
    }
    
    .star-filled {
        color: var(--accent-yellow);
    }
    
    .star-half {
        position: relative;
        color: #e2e2e2;
    }
    
    .star-half::after {
        content: '\f089';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 0;
        width: 50%;
        overflow: hidden;
        color: var(--accent-yellow);
    }
    
    .star-empty {
        color: #e2e2e2;
    }
    
    .language-tag {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-navy) 100%);
        color: white;
        border-radius: 50px;
        padding: 0.5rem 1rem;
        display: inline-block;
        margin: 0.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .language-tag:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .course-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .course-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .topic-item {
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--primary-blue);
        transition: all 0.3s ease;
    }
    
    .topic-item:hover {
        transform: translateX(5px);
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
    }
    
    .project-card {
        border: none;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #fff 0%, #f8f9ff 100%);
        border-left: 5px solid var(--accent-yellow);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .project-card:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
      .back-button {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.3);
        color: white;
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 20;
        cursor: pointer;
        font-weight: 500;
    }
      .back-button:hover {
        background: rgba(255, 255, 255, 0.5);
        transform: translateX(-5px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15) !important;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="container-fluid">
    <!-- Dedicated Back Button on top -->
    <div class="mb-4 mt-2">
        <a href="{{ route('landing') }}" class="btn btn-outline-primary d-inline-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
        </a>
    </div>
    
    <div class="course-header">
          <div class="row align-items-center" style="position: relative; z-index: 5;">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="text-white me-4" style="font-size: 3rem;">
                        <i class="{{ $course['icon'] }}"></i>
                    </div>
                    <h1 class="mb-0">{{ $course['title'] }}</h1>
                </div>
                <p class="fs-5 mb-4 opacity-90">{{ $course['description'] }}</p>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="fs-5 fw-semibold me-2">Difficulty: </span>
                        <div class="difficulty-stars">
                            @php
                                $fullStars = floor($course['difficulty']);
                                $halfStar = $course['difficulty'] - $fullStars > 0 ? true : false;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                            @endphp
                            
                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star star-filled me-1"></i>
                            @endfor
                            
                            @if ($halfStar)
                                <i class="fas fa-star star-half me-1"></i>
                            @endif
                            
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="fas fa-star star-empty me-1"></i>
                            @endfor
                            
                            <span class="ms-2">{{ $course['difficulty'] }}/5</span>
                        </div>
                    </div>
                </div>
            </div>            <div class="col-md-4 text-end">
                <a href="{{ route('register') }}" class="d-inline-block bg-white text-primary-navy fw-bold px-4 py-3 rounded-pill shadow text-decoration-none hover-lift">
                    <i class="fas fa-graduation-cap me-2"></i>Enroll Now
                </a>
            </div>
        </div>
    </div>
    
    <!-- Course Content -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Introduction -->
            <div class="card course-card mb-4">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4 text-primary-navy">Course Overview</h3>
                    <p class="card-text">{{ $course['details']['intro'] }}</p>
                </div>
            </div>
            
            <!-- Topics -->
            <div class="card course-card mb-4">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4 text-primary-navy">What You'll Learn</h3>
                    @foreach ($course['details']['topics'] as $topic)
                        <div class="topic-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary-blue me-3"></i>
                                <div>{{ $topic }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Projects -->
            <div class="card course-card mb-4">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4 text-primary-navy">Hands-on Projects</h3>
                    @foreach ($course['details']['projects'] as $index => $project)
                        <div class="project-card p-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="bg-primary-blue text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                                <div>
                                    <h5>{{ $project }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Language and Technologies -->
            <div class="card course-card mb-4">
                <div class="card-body p-4">
                    <h4 class="card-title mb-3 text-primary-navy">Languages & Technologies</h4>
                    <div>
                        @foreach ($course['languages'] as $language)
                            <span class="language-tag">{{ $language }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Course Info -->
            <div class="card course-card mb-4">
                <div class="card-body p-4">
                    <h4 class="card-title mb-3 text-primary-navy">Course Information</h4>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3 text-primary-blue" style="width: 24px;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Duration</div>
                            <div class="text-muted">12 weeks</div>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3 text-primary-blue" style="width: 24px;">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Lectures</div>
                            <div class="text-muted">24 lectures</div>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3 text-primary-blue" style="width: 24px;">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Practical Labs</div>
                            <div class="text-muted">12 hands-on labs</div>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="me-3 text-primary-blue" style="width: 24px;">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Certificate</div>
                            <div class="text-muted">Upon completion</div>
                        </div>
                    </div>
                </div>
            </div>
              <!-- CTA Card -->
            <div class="card border-0 bg-gradient-primary" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-navy) 100%); border-radius: 15px;">
                <div class="card-body p-4 text-center text-white">
                    <h4 class="mb-3">Ready to Start Learning?</h4>
                    <p class="mb-4">Join thousands of students mastering {{ $course['title'] }} with our comprehensive curriculum.</p>
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg w-100 fw-bold text-primary-navy">
                        <i class="fas fa-rocket me-2"></i>Get Started Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
