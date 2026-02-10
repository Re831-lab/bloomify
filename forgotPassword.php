<?php
require"config.php";
$flag = 0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = "";

    if(isset($_POST["email"]))
        $email = $_POST["email"];

    $result = $conn->query("SELECT email FROM customers WHERE email='$email'");

    if($result->num_rows > 0)
        $flag = 1; 
    else
        $flag = -1; 
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Bloomify</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <!-- Back to Home Button -->
    <div class="back-home">
        <a href="index.php" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            <span class="d-none d-sm-inline">Back to Home</span>
            <span class="d-inline d-sm-none">Back</span>
        </a>
    </div>

    <!-- Main Container -->
    <div class="auth-container">
        <div class="auth-card">
            
            <!-- Logo Section -->
            <div class="auth-logo">
                <i class="bi bi-key"></i>
                <h1>Forgot Password?</h1>
                <p>No worries! Enter your email and we'll send you reset instructions</p>
            </div>

            <!-- Form -->
            <form id="forgotPasswordForm" action="forgotPassword.php" method="post">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control-custom" 
                               placeholder="Enter your registered email" 
                               required>
                    </div>
                </div>

                <!-- Alert Messages -->
                <div class="<?php if($flag==1) {echo 'alert alert-success';} else if($flag==-1) {echo 'alert alert-danger';} ?>">
                    <?php 
                    if($flag==1)
                        echo "Reset link sent to your email!";
                    else if($flag==-1)
                        echo "Email not found in our records";
                    ?>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-send"></i>
                    <span>Send Reset Link</span>
                </button>
            </form>

            <!-- Success Message  -->
            <div class="success-message" id="successMessage">
                <div class="success-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h3>Email Sent Successfully!</h3>
                <p>We've sent password reset instructions to</p>
                <p><strong id="emailDisplay"></strong></p>
                <p class="note">Please check your inbox and spam folder</p>
            </div>

            <!-- Divider -->
            <div class="divider"><span>OR</span></div>

            <!-- Back to Login -->
            <div class="alternate-link">
                <i class="bi bi-arrow-left-circle"></i>
                <span class="d-none d-sm-inline">Remember your password?</span>
                <span class="d-inline d-sm-none">Remember?</span>
                <a href="loginn.php">Back to Login</a>
            </div>

            <!-- Help Section -->
            <div class="help-section">
                <p>
                    Still having trouble? 
                    <a href="#" class="contact-link">Contact Support</a>
                </p>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="auth.js"></script>
    <script src="forgotPassword.js"></script>
</body>
</html>