<?php
require"config.php";
session_start();
$flag=0;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email="";
    $password="";


    if(isset($_POST["email"]))
        $email=$_POST["email"];

    if(isset($_POST["password"]))
        $password=$_POST["password"];

    $result=$conn->query("SELECT* from customers where email='$email' and password='$password'");
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION["customer_id"] = $row["customer_id"]; 
        header("location:index.php");
    }
    else
        $flag=1;
   
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bloomify</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <!-- Back to Home -->
    <div class="back-home">
        <a href="index.php" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            <span class="d-none d-sm-inline">Back to Home</span> 
            <span class="d-inline d-sm-none">Back</span> 
        </a>
    </div>

    <!-- Login Container -->
    <div class="auth-container"> 
        <div class="auth-card">
            <div class="auth-logo">
                <i class="bi bi-flower1"></i>
                <h1>Bloomify</h1>
                <p>Welcome back! Please login to your account</p>
            </div>

            <form action="loginn.php" id="loginForm" method="post">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope"></i>
                        <input type="email" id="email" name="email" class="form-control-custom" 
                               placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group-custom">
                        <i class="bi bi-lock"></i>
                        <input type="password" id="password" name="password" class="form-control-custom" 
                               placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="<?php if($flag==1) {echo"alert alert-danger";}?>">
                    <?php 
                    if($flag==1)
                        echo"email or password is incorrect";
                    ?>
                </div>

                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" id="remember">
                        <label for="remember" class="d-none d-sm-inline">Remember me</label>
                        <label for="remember" class="d-inline d-sm-none">Remember</label>
                    </div>
                    <a href="forgotPassword.php" class="forgot-link">
                        <span class="d-none d-sm-inline">Forgot Password?</span>
                        <span class="d-inline d-sm-none">Forgot?</span>
                    </a>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </button>
            </form>

            <div class="divider"><span>OR</span></div>

            <div class="alternate-link">
                <span class="d-none d-sm-inline">Don't have an account?</span>
                <span class="d-inline d-sm-none">New user?</span>
                <a href="register.php">Register Now</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="auth.js"></script>
    <script src="login.js"></script>
</body>
</html>