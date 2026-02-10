<?php
require "config.php";
session_start();

$flowers_query = "SELECT * FROM flowers WHERE stock_quantity > 0 ORDER BY flower_id";
$flowers_result = $conn->query($flowers_query);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Bouquet Designer - Bloomify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="customize.css">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-flower1"></i> Bloomify
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon">
                    <?php
$cart_count = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}

if (isset($_SESSION['custom_order'])) {
    foreach ($_SESSION['custom_order'] as $flower) {
        $cart_count += $flower['qty'];
    }
}

echo $cart_count;
?>

                </span>
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
                        <a class="nav-link active" href="customize.php">Custom Design</a>
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
                            <span class="cart-badge" style="font-size: 0.7rem;">
              <?php 
                $cart_count = 0;
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $cart_count += $item['quantity'];
                    }
                }
                echo $cart_count;
              ?>
            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="page-header-custom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Custom Bouquet</li>
                </ol>
            </nav>
            <h1>Design Your Custom Bouquet</h1>
            <p>Choose your flowers and build a personalized bouquet</p>
        </div>
    </div>

   <!-- MAIN CONTENT -->
<section class="customize-section">
    <div class="container">
        <form method="POST" action="checkout.php" id="customBouquetForm">
            <input type="hidden" name="order_type" value="custom">

            <!-- Flowers Grid -->
            <div class="section-card">
                <h3 class="section-card-title">
                    <i class="bi bi-flower1"></i> Available Flowers
                </h3>
                <div class="row g-3">
                    <?php
                    $flower_num = 1;
                    while ($flower = $flowers_result->fetch_assoc()){
                        $stock_class = $flower['stock_quantity'] < 30 ? 'low' : 'available';
                        $stock_icon = $flower['stock_quantity'] < 30 ? 'bi-exclamation-circle' : 'bi-check-circle';
                    ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="flower-card">
                                <img src="<?php echo $flower['image_url']; ?>" alt="<?php echo $flower['flower_name']; ?>" class="flower-card-img">
                                <div class="flower-card-body">
                                    <h5 class="flower-name"><?php echo $flower['flower_name']; ?></h5>
                                    <p class="flower-color"><i class="bi bi-palette"></i> <?php echo $flower['color']; ?></p>
                                    <p class="flower-price">$<?php echo number_format($flower['unit_price'], 2); ?> / stem</p>
                                    <p class="flower-stock <?php echo $stock_class; ?>">
                                        <i class="bi <?php echo $stock_icon; ?>"></i>
                                        <?php echo $flower['stock_quantity'] < 30 ? 'Low Stock' : 'In Stock'; ?> (<?php echo $flower['stock_quantity']; ?>)
                                    </p>
                                    <div class="mb-2">
                                        <label class="form-label" style="font-size: 0.85rem;">Quantity:</label>
                                        <input type="number" id="qty_<?php echo $flower_num; ?>" class="form-control form-control-sm"
                                            min="0" max="<?php echo $flower['stock_quantity']; ?>" value="0" placeholder="0">
                                    </div>
                                    <button type="button" class="btn-add-flower"
                                        onclick="selectFlower('<?php echo $flower['flower_name']; ?>', 'qty_<?php echo $flower_num; ?>', <?php echo $flower_num; ?>)">
                                        <i class="bi bi-plus-circle"></i> Select
                                    </button>

                                    <input type="hidden" name="flower_<?php echo $flower_num; ?>_qty" id="flower_<?php echo $flower_num; ?>_qty" value="0">
                                    <input type="hidden" name="flower_<?php echo $flower_num; ?>_id" value="<?php echo $flower['flower_id']; ?>">
                                    <input type="hidden" name="flower_<?php echo $flower_num; ?>_name" value="<?php echo $flower['flower_name']; ?>">
                                    <input type="hidden" name="flower_<?php echo $flower_num; ?>_price" value="<?php echo $flower['unit_price']; ?>">
                                    <input type="hidden" name="flower_<?php echo $flower_num; ?>_image" value="<?php echo $flower['image_url']; ?>">
                                </div>
                            </div>
                        </div>
                    <?php
                        $flower_num++;
                    }
                    ?>
                </div>
            </div>

            <!-- Proceed to Checkout Button -->
            <div class="mt-5 mb-5">
                <div class="section-card" style="background: linear-gradient(135deg, var(--beige-light) 0%, white 100%); border: 2px solid var(--turquoise); padding: 2rem;">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-7 mb-3 mb-md-0">
                            <h4 style="color: var(--crimson); margin-bottom: 0.5rem; font-family: 'Playfair Display', serif;">
                                <i class="bi bi-check-circle" style="color: var(--turquoise);"></i> Ready to Order?
                            </h4>
                            <p style="color: var(--text-light); margin: 0; font-size: 0.95rem;">
                                Continue to checkout to complete your custom bouquet order
                            </p>
                        </div>
                        <div class="col-12 col-md-5 text-md-end">
                            <button type="submit" class="btn btn-place-order" style="width: 100%; max-width: 300px;">
                                <i class="bi bi-arrow-right-circle"></i> Proceed to Checkout
                            </button>
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

    <script>
        function selectFlower(flowerName, qtyInputId, flowerNum) {
            var qtyInput = document.getElementById(qtyInputId);
            var quantity = qtyInput.value;

            if (quantity == "" || quantity == "0") {
                alert("Please enter a quantity for " + flowerName);
                return;
            }

            var hiddenInput = document.getElementById('flower_' + flowerNum + '_qty');
            hiddenInput.value = quantity;

            alert("✓ Selected " + quantity + " stems of " + flowerName);
        }

        document.getElementById('customBouquetForm').onsubmit = function(e) {
            var hasFlowers = false;

            for (var i = 1; i <= 6; i++) {
                var hiddenQty = document.getElementById('flower_' + i + '_qty');
                if (hiddenQty && hiddenQty.value != "0" && hiddenQty.value != "") {
                    hasFlowers = true;
                    break;
                }
            }

            if (!hasFlowers) {
                e.preventDefault();
                alert("Please select at least one flower for your custom bouquet!");
                return false;
            }

            return true;
        };
    </script>
</body>

</html>