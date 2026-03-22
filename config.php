<?php
$host = "mysql.railway.internal";
$user = "root";
$password = "gtnpleRHzzEcNnnxhugIBarJSvORsrVW";
$db = "railway";
$conn = new mysqli($host, $user, $password, $db);
if($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
?>
