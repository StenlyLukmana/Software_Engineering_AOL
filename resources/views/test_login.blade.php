<!DOCTYPE html>
<html>
<head>
    <title>Quick Login Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Quick Login Test</h3>
                    </div>
                    <div class="card-body">
                        <form action="/login" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <div class="mb-3">
                                <label class="form-label">Test Accounts</label>
                                <div class="alert alert-info">
                                    <strong>Admin:</strong> admin@example.com / password<br>
                                    <strong>Lecturer:</strong> lecturer@example.com / password<br>
                                    <strong>Student:</strong> student@example.com / password
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="admin@example.com" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       value="password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        
                        <hr>
                        
                        <div class="mt-3">
                            <a href="/quiz/create" class="btn btn-success">Test Quiz Create (After Login)</a>
                            <a href="/debug/quiz-create" class="btn btn-info">Debug Quiz Create (No Auth)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
