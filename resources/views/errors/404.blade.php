@extends('layouts.main')

@section('title', '404 - Page Not Found')

@section('content')
<div class="error-container">
    <div class="error-content">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1 class="error-title">404</h1>
        <h2 class="error-subtitle">Page Not Found</h2>
        <p class="error-message">
            Sorry, the page you are looking for could not be found. It might have been moved, deleted, or the URL might be incorrect.
        </p>
        <div class="error-actions">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="fas fa-home"></i> Go to Dashboard
            </a>
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
    </div>
</div>

<style>
.error-container {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.error-content {
    text-align: center;
    max-width: 500px;
}

.error-icon {
    font-size: 4rem;
    color: var(--warning-color);
    margin-bottom: 1rem;
    animation: pulse 2s infinite;
}

.error-title {
    font-size: 6rem;
    font-weight: 800;
    color: var(--primary-color);
    margin: 0;
    line-height: 1;
}

.error-subtitle {
    font-size: 2rem;
    font-weight: 600;
    color: var(--secondary-color);
    margin: 0.5rem 0 1rem 0;
}

.error-message {
    font-size: 1.1rem;
    color: var(--text-muted);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

@media (max-width: 768px) {
    .error-title {
        font-size: 4rem;
    }
    
    .error-subtitle {
        font-size: 1.5rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 200px;
    }
}
</style>
@endsection
