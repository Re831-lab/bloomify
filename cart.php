<?php
session_start();
require "config.php";

$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Bloomify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="cart.css">
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
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="icon-btn" onclick="window.location.href='cart.php'">
                            <i class="bi bi-cart3"></i>
                            <span class="cart-badge"><?php echo $cart_count; ?></span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header-cart">
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="Products.php">Products</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
            </nav>
            <h1>Shopping Cart</h1>
            <p>Review your selected arrangements before checkout</p>
        </div>
    </div>

    <section class="cart-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="cart-items-header">
                        <h3><i class="bi bi-basket3"></i> Cart Items</h3>
                        <?php if (!empty($_SESSION['cart'])) {
                            echo ' <form method="post" action="clear_cart.php">
                                <button type="submit" class="btn-clear-all"><i class="bi bi-trash"></i> Clear All</button>
                            </form>';
                        } ?>
                    </div>

                    <div class="cart-items-list">
                        <?php
                        $total_price = 0;

                        if (empty($_SESSION['cart'])) {
                            echo "<div class='alert alert-info'>Your cart is empty. <a href='index.php'>Go Shopping!</a></div>";
                        } else {
                            foreach ($_SESSION['cart'] as $index => $item) {
                                $subtotal = $item['price'] * $item['quantity'];
                                $total_price += $subtotal;
                        ?>

                                <div class="cart-item-card">
                                    <div class="cart-item-image">
                                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                    </div>
                                                               

                                    <div class="cart-item-info">
                                        <h4 class="cart-item-name"><?php echo $item['name']; ?></h4>
                                        <p class="cart-item-category"><i class="bi bi-tag"></i> Arrangement</p>
                                        <p class="cart-item-price">$<?php echo $item['price']; ?></p>
                                    </div>
                                        

                                    <div class="cart-item-actions">
                                             

                                        <form method="post" action="update_cart.php" style="display:inline;">
                                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                                            <div class="quantity-controls-cart">
                                                <button type="submit" name="action" value="decrease" class="qty-btn-cart">−</button>
                                                <input type="number" class="qty-input-cart" value="<?php echo $item['quantity']; ?>" readonly>
                                                <button type="submit" name="action" value="increase" class="qty-btn-cart">+</button>
                                            </div>
                                                  

                                        </form>
                                        <div class="cart-item-subtotal">$<?php echo $subtotal; ?></div>
                                        <form method="post" action="remove_from_cart.php" style="display:inline;">
                                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                                            <button type="submit" class="btn-remove-item" title="Remove"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </div>

                        <?php
                            }
                        }; ?>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="cart-summary-card">
                        <h3 class="summary-title"><i class="bi bi-receipt"></i> Order Summary</h3>

                        <div class="summary-row">
                            <span>Arrangements Total:</span>
                            <span>$<?php echo $total_price; ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Delivery Fee:</span>
                            <span>$10.00</span>
                        </div>
                        <hr class="summary-divider">
                        <div class="summary-row summary-total">
                            <span>Final Amount:</span>
                            <span>$<?php echo ($total_price > 0) ? $total_price + 10 : 0; ?></span>
                        </div>

                       <?php
if ($total_price > 0 || (!empty($_SESSION['custom_order']))) {
    echo '
    <form method="post" action="checkout.php">
        <button type="submit" class="btn-checkout">
            <i class="bi bi-credit-card"></i> Proceed to Checkout
        </button>
    </form>
    ';
}
?>


                        <div class="continue-shopping">
                            <a href="Products.php"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
                        </div>

                        <div class="cart-features">
                            <div class="feature-item">
                                <i class="bi bi-shield-check"></i>
                                <span>Secure Checkout</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-truck"></i>
                                <span>Same-Day Delivery</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-arrow-return-left"></i>
                                <span>Easy Returns</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact">
        <div class="container">
            <div class="row">
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

                <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="Products.php">Products</a></li>
                        <li><a href="customize.php">Custom Design</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Delivery Info</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

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
    <script src="common.js"></script>
    <script src="cart.js"></script>
</body>

</html>