<!DOCTYPE html>
<html>
<head>
    <title>Login Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Quick Login Test</h1>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Login</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="admin@cslearning.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="admin123">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Test Accounts</h5>
                    </div>
                    <div class="card-body">                        <p><strong>Admin:</strong> admin@cslearning.com / admin123</p>
                        <p><strong>Lecturer:</strong> john.smith@cslearning.com / lecturer123</p>
                        <p><strong>Student:</strong> alice.cooper@student.cslearning.com / student123</p>
                        
                        <hr>
                        <p><strong>Current User:</strong></p>
                        @auth
                            <div class="alert alert-success">
                                Logged in as: {{ auth()->user()->name }} ({{ auth()->user()->role }})
                                <br>
                                <a href="{{ route('quiz.create') }}" class="btn btn-primary btn-sm mt-2">Go to Quiz Create</a>
                            </div>
                        @else
                            <div class="alert alert-warning">Not logged in</div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="/test-quiz-create" class="btn btn-info">Test Quiz Create (No Auth)</a>
            <a href="/quiz/create" class="btn btn-warning">Quiz Create (With Auth)</a>
        </div>
    </div>
</body>
</html>
