<?php
session_start();
require"config.php";
$flag=0;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username="";
    $email="";
    $password="";
    $confirmPassword="";

    if(isset($_POST["username"]))
        $username=$_POST["username"];


    if(isset($_POST["email"]))
        $email=$_POST["email"];

    if(isset($_POST["password"]))
        $password=$_POST["password"];

    if(isset($_POST["confirmPassword"]))
        $confirmPassword=$_POST["confirmPassword"];

    if($password !== $confirmPassword)
        echo"check confirm password";

    $parts=explode(' ', $username);
    $first_name=$parts[0];
    $last_name='';
    if(count($parts)>1){
        array_shift($parts);
        $last_name=implode(' ',$parts);
    }
    $result=$conn->query("INSERT INTO customers (first_name,last_name, email, password) VALUES ('$first_name','$last_name','$email', '$password')");    
    if($result==TRUE){
        $flag=1;
        header("location: loginn.php");
    }
    else
        $flag=-1;
   
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bloomify</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
<link rel="stylesheet" href="auth.css">

</head>
<body>
    

    <div class="back-home">
        <a href="index.html" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Home</span>
        </a>
    </div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-logo">
                <i class="bi bi-person-plus"></i>
                <h1>Join Bloomify</h1>
                <p>Create your account and start your floral journey</p>
            </div>

            

            <form id="registerForm" action="register.php" method="post">
                <div class="form-group">
                    <label class="form-label" for="fullName">Full Name</label>
                    <div class="input-group-custom">
                        <i class="bi bi-person"></i>
                        <input type="text" id="fullName" name="username" class="form-control-custom" 
                               placeholder="Enter your full name" required>
                    </div>
                </div>

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
                               placeholder="Create a strong password" required>
                    </div>
                    <small class="password-hint">Min 8 characters with uppercase, lowercase & numbers</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                    <div class="input-group-custom">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control-custom" 
                               placeholder="Re-enter your password" required>
                    </div>
                </div>

                <div class="form-check-terms">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">
                        I agree to the <a href="#" class="terms-link">Terms & Conditions</a>
                    </label>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-person-check"></i>
                    <span>Create Account</span>
                </button>
            </form>


            <div class="<?php if($flag==1) {echo"alert alert-success";} else if($flag==-1){echo"alert alert-danger";}?>">
                    <?php 
                    if($flag==1)
                        echo"user addedd successfully";
                    else if($flag==-1)
                        echo"user not added";
                    ?>
                </div>

            <div class="divider"><span>OR</span></div>

            <div class="alternate-link">
                Already have an account? <a href="loginn.php">Login</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="auth.js"></script>
    <script src="register.js"></script>
</body>
</html>