<?php
require "config.php";
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION["customer_id"])) {
    header("Location: loginn.php");
    exit;
}

$customer_id = $_SESSION["customer_id"];

// بجيب الطلبات من الداتابيز حسب الاجدد
$sql = "SELECT * FROM orders WHERE customer_id = $customer_id ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Bloomify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="orders.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-flower1"></i> Bloomify
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav mx-auto nav-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="Products.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#occasions">Occasions</a></li>
                    <li class="nav-item"><a class="nav-link" href="customize.php">Custom Design</a></li>
                </ul>
                <ul class="navbar-nav navbar-icons ms-lg-auto">
                    <li class="nav-item dropdown">
                        <button class="icon-btn dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end account-dropdown">
                            <li><a class="dropdown-item" href="loginn.php"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                            <li><a class="dropdown-item" href="register.php"><i class="bi bi-person-plus"></i> Register</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="orders.php"><i class="bi bi-bag-check"></i> My Orders</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="icon-btn" onclick="window.location.href='cart.php'">
                            <i class="bi bi-cart3"></i>
                            <span class="cart-badge">0</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header-orders">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">My Account</a></li>
                    <li class="breadcrumb-item active">My Orders</li>
                </ol>
            </nav>
            <h1>My Orders</h1>
            <p>Track and manage your flower orders</p>
        </div>
    </div>

    <section class="orders-section">
        <div class="container">
            <div class="orders-content">
                <div class="filter-bar">
                    <form method="GET" action="orders.php">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <h5 class="mb-0"><i class="bi bi-funnel"></i> Filter Orders</h5>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <select class="form-select" name="status">
                                    <option value="all">All Orders</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Out for Delivery">Out for Delivery</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="orders-count">
                    Showing <strong><?php echo $result->num_rows; ?></strong> orders
                </div>

                <div id="ordersGrid">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $order_id = $row['order_id'];
                            $status = $row['status'];
                            $order_date = date("Y-m-d", strtotime($row['order_date']));
                            $total_amount = $row['total_amount'];
                            $payment_method = $row['payment_method'];
                            $payment_status = $row['payment_status'];


                            $status_class = strtolower(str_replace(' ', '-', $status));

                            $payment_class = strtolower($payment_status) == 'paid' ? 'paid' : 'pending';

                            $items_sql = "SELECT SUM(quantity) as qty FROM order_arrangements WHERE order_id = $order_id";
                            $items_res = $conn->query($items_sql);
                            $row = $items_res->fetch_assoc();
                            if ($row && isset($row['qty'])) {
                                $items_count = $row['qty'];
                            } else {
                                $items_count = 0;
                            }

                    ?>

                            <div class="order-card">
                                <div class="order-header">
                                    <div class="order-number">
                                        <i class="bi bi-receipt"></i>
                                        #BLM-<?php echo $order_id; ?>
                                    </div>
                                    <span class="order-status <?php echo $status_class; ?>">
                                        <i class="bi bi-clock-history"></i>
                                        <?php echo $status; ?>
                                    </span>
                                </div>
                                <div class="order-body">
                                    <div class="order-info-item">
                                        <span class="order-info-label">
                                            <i class="bi bi-calendar3"></i> Order Date
                                        </span>
                                        <span class="order-info-value"><?php echo $order_date; ?></span>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="order-info-label">
                                            <i class="bi bi-box-seam"></i> Items
                                        </span>
                                        <span class="order-info-value"><?php echo $items_count; ?> items</span>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="order-info-label">
                                            <i class="bi bi-cash-coin"></i> Total Amount
                                        </span>
                                        <span class="order-info-value order-total">$ <?php echo $total_amount; ?></span>
                                    </div>
                                </div>
                                <div class="order-footer">
                                    <div class="order-payment-info">
                                        <span class="payment-method">
                                            <i class="bi bi-credit-card"></i>
                                            <?php echo $payment_method; ?>
                                        </span>
                                        <span class="payment-status <?php echo $payment_class; ?>">
                                            <?php echo $payment_status; ?>
                                        </span>
                                    </div>
                                    <a href="order-details.php?id=<?php echo $order_id; ?>" class="btn-view-details">
                                        View Details <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<div class="alert alert-info text-center p-5">You have no orders yet. <a href="Products.php" class="alert-link">Start Shopping</a></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact">
        <div class="container">
            <div class="row">
                <!-- Bloomify Section -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
                    <h5><i class="bi bi-flower1"></i> Bloomify</h5>
                    <p>Creating beautiful moments with fresh flowers since 2025.</p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-pinterest"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="Products.php">Products</a></li>
                        <li><a href="customize.php">Custom Design</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Delivery Info</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="bi bi-geo-alt"></i> 123 Flower Street, City</p>
                    <p><i class="bi bi-telephone"></i> +907 (555) 123-4567</p>
                    <p><i class="bi bi-envelope"></i> info@Bloomify.com</p>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Bloomify. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>