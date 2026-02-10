<?php
// Database Configuration Example
// Copy this file to config.php and update with your credentials

$host = "localhost";
$user = "your_database_username";
$password = "your_database_password";
$db = "your_database_name";

$conn = new mysqli($host, $user, $password, $db);

if($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
?>