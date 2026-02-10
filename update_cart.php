<?php
session_start();

$index = $_POST["index"];
$action = $_POST["action"];

if (isset($_SESSION["cart"][$index])) {
    if ($action == "increase") {
        $_SESSION["cart"][$index]['quantity'] += 1;
    } else if ($action == "decrease") {
        $_SESSION["cart"][$index]['quantity'] -= 1;
        
        if ($_SESSION["cart"][$index]['quantity'] <= 0) {
            unset($_SESSION["cart"][$index]);
           
            $_SESSION["cart"] = array_values($_SESSION["cart"]);
        }
    }
}

header("location: cart.php");
?>