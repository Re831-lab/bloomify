<?php
session_start();
require "config.php";

if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) {
    die("Your cart is empty. Cannot place order.");
}

if (!isset($_SESSION["customer_id"])) {
    die("You must log in to place an order.");
}

$customer_id = $_SESSION["customer_id"];

$customer_name = $_POST["customer_name"];
$customer_email = $_POST["customer_email"];
$customer_phone = $_POST["customer_phone"];
$delivery_date = $_POST["delivery_date"];
$delivery_time = $_POST["delivery_time"];
$delivery_address = $_POST["delivery_address"];
$card_message = $_POST["card_message"];
$special_instructions = $_POST["special_instructions"];
$payment_method = $_POST["payment_method"];

$subtotal = 0;
foreach ($_SESSION["cart"] as $item) {
    $subtotal += $item["price"] * $item["quantity"];
}

if (isset($_SESSION['custom_total'])) {
    $subtotal += $_SESSION['custom_total'];
}

$delivery_fee = 10;
$total_amount = $subtotal + $delivery_fee;

$order_sql = "
    INSERT INTO orders 
    (customer_id, order_date, delivery_date, delivery_time, delivery_address, 
     total_amount, delivery_fee, payment_method, status, card_message, special_instructions)
    VALUES 
    ($customer_id, NOW(), '$delivery_date', '$delivery_time', '$delivery_address',
     $total_amount, $delivery_fee, '$payment_method', 'Processing', '$card_message', '$special_instructions')
";

if (!$conn->query($order_sql)) {
    die("Error inserting order: " . $conn->error);
}

$order_id = $conn->insert_id;

foreach ($_SESSION["cart"] as $item) {
    $arrangement_id = $item["arrangement_id"];
    $qty = $item["quantity"];
    $unit_price = $item["price"];

    $details_sql = "
        INSERT INTO order_arrangements (order_id, arrangement_id, quantity, unit_price)
        VALUES ($order_id, $arrangement_id, $qty, $unit_price)
    ";

    $conn->query($details_sql);

        $update_stock_sql = "
            UPDATE arrangements 
            SET stock_quantity = stock_quantity - $qty 
            WHERE arrangement_id = $arrangement_id
        ";
        $conn->query($update_stock_sql);
}


if (isset($_SESSION['custom_order']) && !empty($_SESSION['custom_order'])) {

    foreach ($_SESSION['custom_order'] as $flower) {
        $flower_id = $flower['id'];
        $qty = $flower['qty'];
        $price = $flower['price']; 
        $subtotal = $qty * $price;    


        $sql_custom = "INSERT INTO custom_order_flowers (order_id, flower_id, quantity, subtotal)
                       VALUES ($order_id, $flower_id, $qty, $subtotal)";
        
        if (!$conn->query($sql_custom)) {
   
        }
    }

 
    unset($_SESSION['custom_order']);
    unset($_SESSION['custom_total']);

}


    $_SESSION['cart'] = null;



header("Location: orders.php");
exit;

?>
