<!DOCTYPE html>
<html>
<head>
    <title>Quiz Creation Access Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3><i class="fas fa-check-circle"></i> Quiz Creation Access Verification</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success">
                            <h4>✅ Production Quiz Creation Route Active</h4>
                            <p>The quiz creation form is now accessible at the production route for lecturers and admins.</p>
                        </div>

                        <div class="mb-4">
                            <h5>🔐 Access Control:</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><strong>Admin:</strong> Full access to quiz creation</span>
                                    <span class="badge bg-success">✅ Authorized</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><strong>Lecturer:</strong> Full access to quiz creation</span>
                                    <span class="badge bg-success">✅ Authorized</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><strong>Student:</strong> No access to quiz creation</span>
                                    <span class="badge bg-danger">❌ Restricted</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h5>📋 Test Accounts:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary">Admin Account</h6>
                                            <p class="card-text">
                                                <strong>Email:</strong> admin@example.com<br>
                                                <strong>Password:</strong> password
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-info">
                                        <div class="card-body">
                                            <h6 class="card-title text-info">Lecturer Account</h6>
                                            <p class="card-text">
                                                <strong>Email:</strong> lecturer@example.com<br>
                                                <strong>Password:</strong> password
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>🚀 Testing Steps:</h5>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item">Login with admin or lecturer credentials below</li>
                                <li class="list-group-item">Navigate to Quiz Creation</li>
                                <li class="list-group-item">Verify the form loads properly</li>
                                <li class="list-group-item">Test creating a quiz with questions</li>
                            </ol>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <h6>🔑 Quick Login:</h6>
                                <form action="/login" method="POST" class="mb-3">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="email" value="admin@example.com">
                                    <input type="hidden" name="password" value="password">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-sign-in-alt"></i> Login as Admin
                                    </button>
                                </form>
                                
                                <form action="/login" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="email" value="lecturer@example.com">
                                    <input type="hidden" name="password" value="password">
                                    <button type="submit" class="btn btn-info w-100">
                                        <i class="fas fa-chalkboard-teacher"></i> Login as Lecturer
                                    </button>
                                </form>
                            </div>
                            
                            <div class="col-md-6">
                                <h6>🎯 Direct Access:</h6>
                                <a href="/quiz/create" class="btn btn-success w-100 mb-2">
                                    <i class="fas fa-plus-circle"></i> Go to Quiz Creation
                                </a>
                                <a href="/quiz" class="btn btn-outline-success w-100 mb-2">
                                    <i class="fas fa-list"></i> View All Quizzes
                                </a>
                                <a href="/dashboard" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4">
                            <strong>Note:</strong> You must be logged in as an admin or lecturer to access the quiz creation form. 
                            Students will be redirected or receive a 403 Forbidden error.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
</body>
</html>
