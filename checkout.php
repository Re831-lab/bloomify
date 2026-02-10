<?php
require "config.php";
session_start();

if (isset($_POST['order_type']) && $_POST['order_type'] == 'custom') {

    $total = 0;
    $custom_flowers = [];

    if (isset($_POST['flower_1_qty']) && $_POST['flower_1_qty'] > 0) {
        $flower1 = [
            'id' => $_POST['flower_1_id'],
            'name' => $_POST['flower_1_name'],
            'qty' => $_POST['flower_1_qty'],
            'price' => $_POST['flower_1_price']
        ];
        $custom_flowers[] = $flower1;
        $total += $_POST['flower_1_qty'] * $_POST['flower_1_price'];
    }

    if (isset($_POST['flower_2_qty']) && $_POST['flower_2_qty'] > 0) {
        $flower2 = [
            'id' => $_POST['flower_2_id'],
            'name' => $_POST['flower_2_name'],
            'qty' => $_POST['flower_2_qty'],
            'price' => $_POST['flower_2_price']
        ];
        $custom_flowers[] = $flower2;
        $total += $_POST['flower_2_qty'] * $_POST['flower_2_price'];
    }

    if (isset($_POST['flower_3_qty']) && $_POST['flower_3_qty'] > 0) {
        $flower3 = [
            'id' => $_POST['flower_3_id'],
            'name' => $_POST['flower_3_name'],
            'qty' => $_POST['flower_3_qty'],
            'price' => $_POST['flower_3_price']
        ];
        $custom_flowers[] = $flower3;
        $total += $_POST['flower_3_qty'] * $_POST['flower_3_price'];
    }

    if (isset($_POST['flower_4_qty']) && $_POST['flower_4_qty'] > 0) {
        $flower4 = [
            'id' => $_POST['flower_4_id'],
            'name' => $_POST['flower_4_name'],
            'qty' => $_POST['flower_4_qty'],
            'price' => $_POST['flower_4_price']
        ];
        $custom_flowers[] = $flower4;
        $total += $_POST['flower_4_qty'] * $_POST['flower_4_price'];
    }

    if (isset($_POST['flower_5_qty']) && $_POST['flower_5_qty'] > 0) {
        $flower5 = [
            'id' => $_POST['flower_5_id'],
            'name' => $_POST['flower_5_name'],
            'qty' => $_POST['flower_5_qty'],
            'price' => $_POST['flower_5_price']
        ];
        $custom_flowers[] = $flower5;
        $total += $_POST['flower_5_qty'] * $_POST['flower_5_price'];
    }

    if (isset($_POST['flower_6_qty']) && $_POST['flower_6_qty'] > 0) {
        $flower6 = [
            'id' => $_POST['flower_6_id'],
            'name' => $_POST['flower_6_name'],
            'qty' => $_POST['flower_6_qty'],
            'price' => $_POST['flower_6_price']
        ];
        $custom_flowers[] = $flower6;
        $total += $_POST['flower_6_qty'] * $_POST['flower_6_price'];
    }

    $_SESSION['custom_order'] = $custom_flowers;
    $_SESSION['custom_total'] = $total;
}


$final_total = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $final_total += $item['price'] * $item['quantity'];
    }
}

if (isset($_SESSION['custom_total'])) {
    $final_total += $_SESSION['custom_total'];
}

if ($final_total == 0) {
    header("Location: index.php");
    exit;
}

$delivery = 10;
$final_price = $final_total + $delivery;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Bloomify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="checkout.css">
</head>

<body>
    <!-- NAVBAR -->
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Products.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#occasions">Occasions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customize.php">Custom Design</a>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-icons ms-lg-auto">
                    <li class="nav-item dropdown">
                        <button class="icon-btn dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end account-dropdown">
                            <li><a class="dropdown-item" href="loginn.php"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                            <li><a class="dropdown-item" href="register.php"><i class="bi bi-person-plus"></i> Register</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="orders.php"><i class="bi bi-bag-check"></i> My Orders</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="icon-btn" onclick="window.location.href='cart.php'">
                            <i class="bi bi-cart3"></i>
                            <span class="cart-badge">3</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="page-header-checkout">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </nav>
            <h1>Checkout</h1>
            <p>Complete your order and get your flowers delivered</p>
        </div>
    </div>

    <!-- CHECKOUT SECTION -->
    <section class="checkout-section">
        <div class="container">
            <!-- Main Checkout Form -->
            <form method="POST" action="process_order.php" id="checkoutForm">

                <div class="row g-4">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">

                        <!-- Customer Information Card -->
                        <div class="checkout-card">
                            <div class="card-header-custom">
                                <h3><i class="bi bi-person-circle"></i> Customer Information</h3>
                            </div>
                            <div class="card-body-custom">
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" name="customer_name" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <label class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" name="customer_phone" placeholder="0 (555) 123-4567" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" name="customer_email" placeholder="your@email.com" required>
                                    </div>
                                </div>

                                <div class="login-prompt">
                                    <i class="bi bi-info-circle"></i>
                                    <span>Already have an account?</span>
                                    <a href="loginn.php">Login here</a>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Details Card -->
                        <div class="checkout-card">
                            <div class="card-header-custom">
                                <h3><i class="bi bi-truck"></i> Delivery Details</h3>
                            </div>
                            <div class="card-body-custom">
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <label class="form-label">Delivery Date *</label>
                                        <input type="date" class="form-control" name="delivery_date" required>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <label class="form-label">Delivery Time *</label>
                                        <input type="time" class="form-control" name="delivery_time" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Delivery Address *</label>
                                        <textarea class="form-control" name="delivery_address" rows="3" placeholder="Enter complete delivery address" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Card Message (Optional)</label>
                                        <textarea class="form-control" name="card_message" rows="2" maxlength="200" placeholder="Add a personal message for the recipient"></textarea>
                                        <small class="text-muted">Max 200 characters</small>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Special Instructions (Optional)</label>
                                        <textarea class="form-control" name="special_instructions" rows="2" placeholder="Any special delivery instructions?"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Card -->
                        <div class="checkout-card">
                            <div class="card-header-custom">
                                <h3><i class="bi bi-credit-card"></i> Payment Method</h3>
                            </div>
                            <div class="card-body-custom">
                                <div class="payment-methods">
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="Cash on Delivery" checked>
                                        <div class="payment-content">
                                            <i class="bi bi-cash-coin"></i>
                                            <div>
                                                <strong>Cash on Delivery</strong>
                                                <span>Pay when you receive your order</span>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="payment-option payment-disabled">
                                        <input type="radio" name="payment_method" value="Credit Card" disabled>
                                        <div class="payment-content">
                                            <i class="bi bi-credit-card-2-front"></i>
                                            <div>
                                                <strong>Credit Card</strong>
                                                <span>Coming soon</span>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="payment-option payment-disabled">
                                        <input type="radio" name="payment_method" value="PayPal" disabled>
                                        <div class="payment-content">
                                            <i class="bi bi-paypal"></i>
                                            <div>
                                                <strong>PayPal</strong>
                                                <span>Coming soon</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: Order Summary -->
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="order-summary-sticky">
                            <div class="checkout-card">
                                <div class="card-header-custom">
                                    <h3><i class="bi bi-receipt"></i> Order Summary</h3>
                                </div>
                                <div class="card-body-custom">

                                    <!-- Order Items -->
                                    <div class="summary-items">
                                        <?php
                                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                            foreach ($_SESSION['cart'] as $item) {
                                                $item_total = $item['price'] * $item['quantity'];
                                        ?>
                                                <div class="summary-item">
                                                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="summary-item-image">
                                                    <div class="summary-item-info">
                                                        <div class="summary-item-name"><?php echo $item['name']; ?></div>
                                                        <div class="summary-item-details">Qty: <?php echo $item['quantity']; ?></div>
                                                    </div>
                                                    <div class="summary-item-price">$<?php echo number_format($item_total, 2); ?></div>
                                                </div>
                                            <?php
                                            }
                                        }

                                        if (isset($_SESSION['custom_order']) && !empty($_SESSION['custom_order'])) {
                                            foreach ($_SESSION['custom_order'] as $flower) {
                                                $item_total = $flower['qty'] * $flower['price'];
                                            ?>
                                                <div class="summary-item">
                                                    <div class="summary-item-info">
                                                        <div class="summary-item-name"><?php echo $flower['name']; ?> <span class="badge bg-info">Custom</span></div>
                                                        <div class="summary-item-details">Qty: <?php echo $flower['qty']; ?> stems</div>
                                                    </div>
                                                    <div class="summary-item-price">$<?php echo number_format($item_total, 2); ?></div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                    <!-- Totals -->
                                    <div class="summary-row">
                                        <span>Subtotal:</span>
                                        <span>$<?php echo number_format($final_total, 2); ?></span>
                                    </div>
                                    <div class="summary-row">
                                        <span>Delivery Fee:</span>
                                        <span>$<?php echo number_format($delivery, 2); ?></span>
                                    </div>
                                    <div class="summary-row">
                                        <span>Discount:</span>
                                        <span class="text-success">-$0.00</span>
                                    </div>
                                    <hr class="summary-divider">
                                    <div class="summary-row summary-total">
                                        <span>Total Amount:</span>
                                        <span>$<?php echo number_format($final_price, 2); ?></span>
                                    </div>

                                   

                                    <!-- Place Order Button -->
                                    <button type="submit" class="btn-place-order">
                                        <i class="bi bi-check-circle"></i>
                                        Place Order
                                    </button>

                                    <!-- Back to Cart -->
                                    <div class="back-to-cart">
                                        <a href="cart.php">
                                            <i class="bi bi-arrow-left"></i>
                                            Back to Cart
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Features -->
                            <div class="security-features">
                                <div class="feature-item">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Secure Checkout</span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-truck"></i>
                                    <span>Same-Day Delivery</span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-award"></i>
                                    <span>Quality Guaranteed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- FOOTER -->
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
                        <li><a href="products.php">Products</a></li>
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

    <script>
        document.querySelector('input[name="delivery_date"]').min = new Date().toISOString().split('T')[0];
    </script>
</body>

</html>