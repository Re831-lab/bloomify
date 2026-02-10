<?php
session_start();
require "config.php";

if (!isset($_POST["order_id"])) {
    header("Location: orders.php");
    exit;
}

$order_id = $_POST["order_id"];

$sql = "UPDATE orders SET status = 'Canceled' WHERE order_id = $order_id";

if ($conn->query($sql)) {
    header("Location: orders.php?message=Order canceled successfully");
} 
else {
    header("Location: orders.php?error=Failed to cancel order");
}

exit;
?>