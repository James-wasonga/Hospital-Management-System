<?php session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
$puname=$_POST['username'];	
$ppwd=md5($_POST['password']);
$ret=mysqli_query($con,"SELECT * FROM users WHERE email='$puname' and password='$ppwd'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$pid=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('$pid','$puname','$uip','$status')");
header("location:dashboard.php");
}
else
{
$_SESSION['login']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into userlog(username,userip,status) values('$puname','$uip','$status')");

echo "<script>alert('Invalid username or password');</script>";
echo "<script>window.location.href='user-login.php'</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login | HMS</title>
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
        
        .login-card .create-account {
            font-size: 0.9rem;
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
        
        .input-group-text {
            background-color: white;
        }
        
        .error-message {
            color: #e74a3b;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-7 col-xl-6">
                <div class="brand-wrapper text-center mb-5">
                    <a href="../index.php" class="logo">HMS | Patient Portal</a>
                </div>
                
                <div class="card login-card">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="card-title text-center mb-4">Sign In</h1>
                        
                        <?php if(isset($_SESSION['errmsg']) && !empty($_SESSION['errmsg'])): ?>
                            <div class="alert alert-danger mb-4"><?php echo $_SESSION['errmsg']; ?></div>
                            <?php $_SESSION['errmsg'] = ""; ?>
                        <?php endif; ?>
                        
                        <form method="post" class="needs-validation" novalidate>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="username" name="username" placeholder="name@example.com" required>
                                <label for="username">Email address</label>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                <div class="invalid-feedback">
                                    Please enter your password.
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" name="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                            
                            <div class="text-center mt-4 create-account">
                                Don't have an account? <a href="registration.php" class="text-primary">Sign up</a>
                            </div>
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