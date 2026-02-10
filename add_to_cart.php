<?php
session_start();
require "config.php";

$arrangement_id = isset($_POST["id"]) ? $_POST["id"] : 0;

$query = "SELECT * FROM arrangements WHERE arrangement_id = $arrangement_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $arrangement = $result->fetch_assoc();
    
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    
    $found = false;
    foreach ($_SESSION["cart"] as &$item) {
        if ($item['arrangement_id'] == $arrangement_id) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        $_SESSION["cart"][] = [
            'arrangement_id' => $arrangement['arrangement_id'],
            'name' => $arrangement['arrangement_name'],
            'price' => $arrangement['base_price'],
            'image' => $arrangement['image_url'],
            'quantity' => 1 
        ];
    }
}

header("Location: index.php");
?>