<?php
// Database Configuration Example
// Copy this file to config.php and update with your credentials
$host = "mysql.railway.internal";
$user = "root";
$password = "YOUR_PASSWORD_HERE";
$db = "railway";
$conn = new mysqli($host, $user, $password, $db);
if($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
?>
