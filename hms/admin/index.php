<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
$uname=$_POST['username'];
$upassword=$_POST['password'];

$ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$uname' and password='$upassword'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
header("location:dashboard.php");

}
else
{
$_SESSION['errmsg']="Invalid username or password";

}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
            --text-color: #5a5c69;
        }
        
        body {
            background-color: var(--secondary-color);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            overflow: hidden;
        }
        
        .login-card .card-body {
            padding: 2rem;
        }
        
        .login-card .card-title {
            margin-bottom: 2rem;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .login-card .form-control {
            border-radius: 0.35rem;
            padding: 1rem;
            height: auto;
        }
        
        .login-card .form-floating label {
            color: #6c757d;
        }
        
        .login-card .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
        }
        
        .login-card .btn-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .login-card .forgot-password {
            color: var(--primary-color);
            font-size: 0.85rem;
        }
        
        .brand-wrapper {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .brand-wrapper .logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .error-message {
            color: #e74a3b;
            font-size: 0.9rem;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-7 col-xl-6">
                <div class="brand-wrapper text-center mb-5">
                    <h2 class="logo">Admin Portal</h2>
                </div>
                
                <div class="card login-card">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="card-title text-center mb-4">Admin Sign In</h1>
                        
                        <?php if(isset($_SESSION['errmsg']) && !empty($_SESSION['errmsg'])): ?>
                            <div class="alert alert-danger mb-4"><?php echo htmlentities($_SESSION['errmsg']); ?></div>
                            <?php $_SESSION['errmsg'] = ""; ?>
                        <?php endif; ?>
                        
                        <form method="post" class="needs-validation" novalidate>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                <label for="username">Username</label>
                                <div class="invalid-feedback">
                                    Please enter your username.
                                </div>
                            </div>
                            
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                <div class="invalid-feedback">
                                    Please enter your password.
                                </div>
                            </div>
                            
                            <button type="submit" name="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                            
                            <a href="../../index.php" class="back-link">Back to Home Page</a>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4 text-muted small">
                    &copy; <?php echo date('Y'); ?> Hospital Management System
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict'
            
            var forms = document.querySelectorAll('.needs-validation')
            
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>