<?php
session_start();
require "config.php";

$arrangement_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = "SELECT a.*, c.category_name 
          FROM arrangements a
          LEFT JOIN categories c ON a.category_id = c.category_id
          WHERE a.arrangement_id = $arrangement_id";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    header("Location: Products.php");
    exit();
}

$arrangement = $result->fetch_assoc();


$occ_sql = "SELECT o.occasion_name 
            FROM occasions o
            JOIN arrangement_occasions ao ON o.occasion_id = ao.occasion_id
            WHERE ao.arrangement_id = $arrangement_id";
$occ_result = $conn->query($occ_sql);

$occasion_names = [];
while($row = $occ_result->fetch_assoc()) {
    $occasion_names[] = $row['occasion_name'];
}
$occasion_text = !empty($occasion_names) ? implode(", ", $occasion_names) : "General";


$query_flowers = "SELECT f.flower_name, f.color, af.quantity, f.unit_price
                  FROM arrangement_flowers af
                  JOIN flowers f ON af.flower_id = f.flower_id
                  WHERE af.arrangement_id = $arrangement_id";
$flowers_result = $conn->query($query_flowers);

$cart_count = 0;
if (isset($_SESSION['cart'])) {
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
    <title>Product Details - Bloomify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="product_details.css">
</head>
<body>
    <div class="toast-container" id="toastContainer"></div>

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
                        <a class="nav-link active" href="Products.php">Shop</a>
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
                            <li>
                                <a class="dropdown-item" href="loginn.php">
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="register.php">
                                    <i class="bi bi-person-plus"></i> Register
                                </a>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <a class="dropdown-item" href="orders.php">
                                    <iorder-detai class="bi bi-bag-check"></iorder-detai                               
                                 </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-gear"></i> Settings
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="icon-btn" onclick="window.location.href='cart.php'">
                            <i class="bi bi-cart3"></i>
                            <span class="cart-badge" id="cartBadge">0</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <div class="page-header-small">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="Products.php">Products</a></li>
                    <li class="breadcrumb-item active">Romance Bouquet</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- PRODUCT DETAILS -->
    <section class="product-detail-section">
        <div class="container">
            <div class="row g-4">
                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="product-image-container">
                        <span class="product-badge">Anniversary</span>
                        <img src="https://i.pinimg.com/736x/cc/c9/e7/ccc9e735042da536976a0376836bc8c6.jpg" alt="Romance Bouquet" class="product-main-image" id="mainProductImage">
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="image-gallery">
                        <div class="gallery-item active" onclick="changeMainImage('https://i.pinimg.com/736x/cc/c9/e7/ccc9e735042da536976a0376836bc8c6.jpg', this)">
                            <img src="https://i.pinimg.com/736x/cc/c9/e7/ccc9e735042da536976a0376836bc8c6.jpg" alt="View 1">
                        </div>
                        <div class="gallery-item" onclick="changeMainImage('https://i.pinimg.com/1200x/61/9d/9a/619d9aaa504a4abd4a96a4d71cf0d025.jpg', this)">
                            <img src="https://i.pinimg.com/1200x/61/9d/9a/619d9aaa504a4abd4a96a4d71cf0d025.jpg" alt="View 2">
                        </div>
                        <div class="gallery-item" onclick="changeMainImage('https://i.pinimg.com/1200x/08/f6/e4/08f6e4f1fee3acddf2a28f90b3bb4e11.jpg', this)">
                            <img src="https://i.pinimg.com/1200x/08/f6/e4/08f6e4f1fee3acddf2a28f90b3bb4e11.jpg" alt="View 3">
                        </div>
                        <div class="gallery-item" onclick="changeMainImage('https://i.pinimg.com/1200x/2c/5b/7f/2c5b7fc26b1636afc50dada1449de21d.jpg', this)">
                            <img src="https://i.pinimg.com/1200x/2c/5b/7f/2c5b7fc26b1636afc50dada1449de21d.jpg" alt="View 4">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info-box">
                        <h1 class="product-detail-title">Romance Bouquet</h1>
                        <div class="product-detail-price">$89.99</div>

                        <div class="product-meta">
                            <div class="meta-item">
                                <i class="bi bi-tag"></i>
                                <span class="meta-label">Category:</span>
                                <span class="meta-value">Bouquet</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-calendar-heart"></i>
                                <span class="meta-label">Occasion:</span>
                                <span class="meta-value"><?php echo $occasion_text; ?></span>
                            </div>
                        </div>

                        <p class="product-description">A stunning arrangement of premium red roses and white lilies, perfectly designed to express your deepest emotions. This elegant bouquet features fresh flowers carefully selected and arranged by our expert florists.</p>

                        <span class="stock-status in-stock">
                            <i class="bi bi-check-circle"></i> In Stock
                        </span>

                        <!-- Add to Cart Form -->
                        <form method="POST" action="add-to-cart.php">
                            <input type="hidden" name="id" value="1">
                            <input type="hidden" name="product_name" value="Romance Bouquet">
                            <input type="hidden" name="product_price" value="89.99">
                            <input type="hidden" name="product_image" value="https://i.pinimg.com/736x/cc/c9/e7/ccc9e735042da536976a0376836bc8c6.jpg">

                            <div class="quantity-selector">
                                <span class="quantity-label">Quantity:</span>
                                <div class="quantity-controls">
                                    <button type="button" class="quantity-btn" onclick="decreaseQty()">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" class="quantity-input" name="quantity" id="quantityInput" value="1" min="1" max="10" readonly>
                                    <button type="button" class="quantity-btn" onclick="increaseQty()">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <button type="submit" class="btn-add-cart">
                                    <i class="bi bi-cart-plus"></i>
                                    <span>Add to Cart</span>
                                </button>
                                <a href="customize.php" class="btn-customize" style="text-decoration: none;">
                                    <i class="bi bi-palette"></i>
                                    <span>Customize</span>
                                </a>
                            </div>
                        </form>

                        <div class="product-features">
                            <div class="feature-item">
                                <i class="bi bi-truck"></i>
                                <span>Same-day delivery available</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-award"></i>
                                <span>Premium quality flowers</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-shield-check"></i>
                                <span>100% satisfaction guarantee</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BOUQUET COMPONENTS -->
    <section class="components-section">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Made With</h2>
                <p class="text-muted">Premium flowers carefully selected for this arrangement</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="component-item">
                        <div class="component-icon"><i class="bi bi-flower1"></i></div>
                        <div class="component-name">Red Roses</div>
                        <div class="component-quantity">5 stems</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="component-item">
                        <div class="component-icon"><i class="bi bi-flower2"></i></div>
                        <div class="component-name">White Lilies</div>
                        <div class="component-quantity">3 stems</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="component-item">
                        <div class="component-icon"><i class="bi bi-flower3"></i></div>
                        <div class="component-name">Baby's Breath</div>
                        <div class="component-quantity">Bundle</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="component-item">
                        <div class="component-icon"><i class="bi bi-stars"></i></div>
                        <div class="component-name">Eucalyptus</div>
                        <div class="component-quantity">Greenery</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RELATED PRODUCTS -->
    <section class="related-section">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">You May Also Like</h2>
                <p class="text-muted">Similar arrangements for your special occasions</p>
            </div>

            <div class="row g-4">
                <!-- Product Card 1 -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="product-card">
                        <div class="product-media">
                            <span class="occasion-badge">Birthday</span>
                            <img src="https://i.pinimg.com/736x/c4/71/1e/c4711efc51d947e6c94ebde75bb86e4c.jpg" alt="Pink Paradise">
                        </div>
                        <div class="product-card-body">
                            <h3 class="product-title">Pink Paradise</h3>
                            <p class="product-description">Premium pink roses</p>
                            <div class="product-price">$79.99</div>
                            <div class="product-actions">
                                <form method="POST" action="add_to_cart.php" style="display: inline;">
                                    <input type="hidden" name="id" value="19">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add">
                                        <i class="bi bi-cart-plus"></i>
                                        <span>Add</span>
                                    </button>
                                </form>
                                <a class="btn-details" href="product_details.php?id=19">
                                    <i class="bi bi-eye"></i>
                                    <span>Details</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 2 -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="product-card">
                        <div class="product-media">
                            <span class="occasion-badge">Just Because</span>
                            <img src="https://i.pinimg.com/1200x/0e/56/f3/0e56f3b1a681c45a3d7e1802614fd471.jpg" alt="Sunshine Delight">
                        </div>
                        <div class="product-card-body">
                            <h3 class="product-title">Sunshine Delight</h3>
                            <p class="product-description">Bright sunflowers</p>
                            <div class="product-price">$65.99</div>
                            <div class="product-actions">
                                <form method="POST" action="add_to_cart.php" style="display: inline;">
                                    <input type="hidden" name="id" value="20">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add">
                                        <i class="bi bi-cart-plus"></i>
                                        <span>Add</span>
                                    </button>
                                </form>
                                <a class="btn-details" href="product_details.php?id=20">
                                    <i class="bi bi-eye"></i>
                                    <span>Details</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 3 -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="product-card">
                        <div class="product-media">
                            <span class="occasion-badge">Wedding</span>
                            <img src="https://i.pinimg.com/1200x/2c/5b/7f/2c5b7fc26b1636afc50dada1449de21d.jpg" alt="Pure Elegance">
                        </div>
                        <div class="product-card-body">
                            <h3 class="product-title">Pure Elegance</h3>
                            <p class="product-description">White lilies arrangement</p>
                            <div class="product-price">$95.99</div>
                            <div class="product-actions">
                                <form method="POST" action="add_to_cart.php" style="display: inline;">
                                    <input type="hidden" name="id" value="21">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add">
                                        <i class="bi bi-cart-plus"></i>
                                        <span>Add</span>
                                    </button>
                                </form>
                                <a class="btn-details" href="product_details.php?id=21">
                                    <i class="bi bi-eye"></i>
                                    <span>Details</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 4 -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="product-card">
                        <div class="product-media">
                            <span class="occasion-badge"><?php echo $occasion_text; ?></span>
                            <img src="https://i.pinimg.com/1200x/eb/8d/26/eb8d26b8f1718febb011784f077134f4.jpg" alt="Garden Mix">
                        </div>
                        <div class="product-card-body">
                            <h3 class="product-title">Garden Mix</h3>
                            <p class="product-description">Mixed flowers bouquet</p>
                            <div class="product-price">$72.99</div>
                            <div class="product-actions">
                                <form method="POST" action="add_to_cart.php" style="display: inline;">
                                    <input type="hidden" name="id" value="22">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add">
                                        <i class="bi bi-cart-plus"></i>
                                        <span>Add</span>
                                    </button>
                                </form>
                                <a class="btn-details" href="product_details.php?id=22">
                                    <i class="bi bi-eye"></i>
                                    <span>Details</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="bi bi-flower1"></i> Bloomify</h5>
                    <p>Creating beautiful moments with fresh flowers since 2025.</p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-pinterest"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="Products.php">Products</a></li>
                        <li><a href="Custom Design.php">Custom Design</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Delivery Info</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#FAQ">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
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
    
    <script>
        function changeMainImage(src, element) {
            document.getElementById('mainProductImage').src = src;
            var items = document.querySelectorAll('.gallery-item');
            for (var i = 0; i < items.length; i++) {
                items[i].classList.remove('active');
            }
            element.classList.add('active');
        }

        function increaseQty() {
            var input = document.getElementById('quantityInput');
            var val = parseInt(input.value);
            if (val < 10) input.value = val + 1;
        }

        function decreaseQty() {
            var input = document.getElementById('quantityInput');
            var val = parseInt(input.value);
            if (val > 1) input.value = val - 1;
        }
    </script>
</body>
</html>