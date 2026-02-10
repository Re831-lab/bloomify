<?php
session_start();
require "config.php";

$query = "SELECT a.*, c.category_name 
          FROM arrangements a
          JOIN categories c ON a.category_id = c.category_id
          WHERE a.stock_quantity > 0
          ORDER BY a.arrangement_id";
$result = $conn->query($query);

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
    <title>Shop - Bloomify</title>

    <!--====================== Bootstrap CSS ====================-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <!-- ================Custom Styles ====================-->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="products.css">
</head>

<body>

    <!-- ================= NAVBAR ================= -->
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
                            <span class="cart-badge" id="cartBadge"><?php echo $cart_count; ?></span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ================= PAGE HEADER ================= -->
    <div class="page-header">
        <div class="container">
            <h1>Our Arrangements</h1>
            <p>Browse our beautiful collection</p>
        </div>
    </div>

    <!-- ================= FILTERS DROPDOWN BAR ================= -->
    <div class="filters-bar">
        <div class="container">
            <div class="row align-items-center g-3">
                <!-- Search -->
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search arrangements...">
                    </div>
                </div>

                <!-- Category Dropdown  -->
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-tag me-2"></i>Category
                        </button>
                        <ul class="dropdown-menu filter-dropdown">
                            <li><label class="dropdown-item"><input class="form-check-input me-2" type="checkbox"> Romantic</label></li>
                            <li><label class="dropdown-item"><input class="form-check-input me-2" type="checkbox"> Birthday</label></li>
                            <li><label class="dropdown-item"><input class="form-check-input me-2" type="checkbox"> Wedding</label></li>
                            <li><label class="dropdown-item"><input class="form-check-input me-2" type="checkbox"> Sympathy</label></li>
                        </ul>
                    </div>
                </div>

                <!-- Occasion Dropdown - -->
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-calendar-heart me-2"></i>Occasion
                        </button>
                        <ul class="dropdown-menu filter-dropdown">
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionValentine"> Valentine's Day
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionAnniversary"> Anniversary
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionBirthday"> Birthday
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionWedding"> Wedding
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionGraduation"> Graduation
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionGetWell"> Get Well Soon
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionThankYou"> Thank You
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionNewBaby"> New Baby
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionSympathy"> Sympathy & Funeral
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item">
                                    <input class="form-check-input me-2" type="checkbox" id="occasionJustBecause"> Just Because
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Price Range -->
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-currency-dollar me-2"></i>Price
                        </button>
                        <div class="dropdown-menu filter-dropdown p-3" style="min-width: 250px;">
                            <div class="mb-2">
                                <label class="form-label small">Min Price</label>
                                <input type="number" class="form-control form-control-sm" id="minPrice" placeholder="$0">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">Max Price</label>
                                <input type="number" class="form-control form-control-sm" id="maxPrice" placeholder="$100">
                            </div>
                            <button class="btn btn-primary btn-sm w-100" id="applyPrice">Apply</button>
                        </div>
                    </div>
                </div>

                <!-- Sort -->
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <select class="form-select" id="sortSelect">
                        <option value="default">Sort by</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="name-az">Name: A-Z</option>
                    </select>
                </div>

                <!-- Reset Button -->
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <button class="btn btn-outline-secondary w-100" id="resetFilters" title="Reset Filters">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="container my-5">
        <!-- Results Count -->
        <div class="mb-3">
            <h5 id="resultsCount">Showing <strong>18</strong> products</h5>
        </div>

        <!-- Products Grid - WITH IDs -->
        <div class="row g-4" id="productsGrid">
            <!-- Product 1 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product1">
                <div class="product-card">
                          

                    <div class="product-media">

                        <span class="occasion-badge">Anniversary</span>
                        <img src="https://i.pinimg.com/1200x/d2/8a/62/d28a62936363ac3f40f15cdbeff9045a.jpg" class="img-fluid" alt="Classic Rose Elegance">
                    </div>
                           

                    <div class="product-card-body">
                        <h3 class="product-title">Classic Rose Elegance</h3>
                        <p class="product-description">Premium red roses</p>
                        <div class="product-price">$45.99</div>
                                   

                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="1">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=1">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product2">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Birthday</span>
                        <img src="https://i.pinimg.com/736x/a8/63/ac/a863ac5e0c1adb2c90be3f7e05493f2b.jpg" class="img-fluid" alt="Spring Garden Mix">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Spring Garden Mix</h3>
                        <p class="product-description">Seasonal flowers</p>
                        <div class="product-price">$38.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="2">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=2">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product3">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Wedding</span>
                        <img src="https://i.pinimg.com/736x/7a/53/aa/7a53aa225ddb4a0995610ad6785a9c71.jpg" class="img-fluid" alt="Luxury Peonies">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Luxury Peonies</h3>
                        <p class="product-description">Pink peonies</p>
                        <div class="product-price">$65.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="3">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=3">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product4">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Birthday</span>
                        <img src="https://i.pinimg.com/1200x/7b/19/47/7b1947b950adde1d31dded39628af2f1.jpg" class="img-fluid" alt="Blossom Harmony">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Blossom Harmony</h3>
                        <p class="product-description">Colorful mix</p>
                        <div class="product-price">$49.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="4">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=4">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product5">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Sympathy</span>
                        <img src="https://i.pinimg.com/736x/ae/27/42/ae27429867ba2fa156a95b8521f42037.jpg" class="img-fluid" alt="White Serenity">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">White Serenity</h3>
                        <p class="product-description">White roses</p>
                        <div class="product-price">$42.50</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="5">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=5">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product6">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Birthday</span>
                        <img src="https://i.pinimg.com/1200x/de/36/88/de3688c5aeec84964b0c770da5bdd555.jpg" class="img-fluid" alt="Sunny Bouquet">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Sunny Bouquet</h3>
                        <p class="product-description">Bright sunflowers</p>
                        <div class="product-price">$34.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="6">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=6">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product7">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Valentine</span>
                        <img src="https://i.pinimg.com/1200x/e2/5f/1c/e25f1cf586d527102d87db97293d83d1.jpg" class="img-fluid" alt="Valentine Romance">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Valentine Romance</h3>
                        <p class="product-description">Red roses with chocolates</p>
                        <div class="product-price">$59.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="7">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=7">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="col-lg-4 col-md-6 col-sm-12 " id="product8">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Thank You</span>
                        <img src="https://i.pinimg.com/1200x/df/54/71/df5471df73a2410f6f0faa3f1e7101f1.jpg" class="img-fluid" alt="Lavender Dreams">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Lavender Dreams</h3>
                        <p class="product-description">Purple lavender bouquet</p>
                        <div class="product-price">$41.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="8">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=8">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 9 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product9">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Just Because</span>
                        <img src="https://i.pinimg.com/1200x/0f/91/f8/0f91f8b8ad2e79cd5e111c800571be93.jpg" class="img-fluid" alt="Tropical Paradise">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Tropical Paradise</h3>
                        <p class="product-description">Exotic tropical flowers</p>
                        <div class="product-price">$55.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="9">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=9">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 10 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product10">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">New Baby</span>
                        <img src="https://i.pinimg.com/1200x/6c/79/d3/6c79d3b9323063c98ef60cc477f20664.jpg" class="img-fluid" alt="Baby Bliss">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Baby Bliss</h3>
                        <p class="product-description">Soft pastel baby arrangement</p>
                        <div class="product-price">$47.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="10">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=10">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 11 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product11">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Graduation</span>
                        <img src="https://i.pinimg.com/736x/1c/0c/5c/1c0c5cffc2e053090cf4852c4e2c6992.jpg" class="img-fluid" alt="Graduation Glory">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Graduation Glory</h3>
                        <p class="product-description">Bright celebration bouquet</p>
                        <div class="product-price">$52.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="11">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=11">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 12 -->
            <div class="col-lg-4 col-md-6 col-sm-12 " id="product12">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Get Well Soon</span>
                        <img src="https://i.pinimg.com/1200x/a1/36/58/a1365836296a63bfc1810cd17f1f923f.jpg" class="img-fluid" alt="Get Well Wishes">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Get Well Wishes</h3>
                        <p class="product-description">Cheerful healing flowers</p>
                        <div class="product-price">$39.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="12">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=12">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 13 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product13">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Anniversary</span>
                        <img src="https://i.pinimg.com/1200x/e2/ec/24/e2ec24979b9d5565aeef9a6fcff63b67.jpg" class="img-fluid" alt="Elegant Orchids">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Elegant Orchids</h3>
                        <p class="product-description">Luxury white orchids</p>
                        <div class="product-price">$72.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="13">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=13">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 14 -->
            <div class="col-lg-4 col-md-6 col-sm-12 " id="product14">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Wedding</span>
                        <img src="https://i.pinimg.com/1200x/eb/be/64/ebbe640b1da3795e1133c91cbe5f5519.jpg" class="img-fluid" alt="Rustic Charm">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Rustic Charm</h3>
                        <p class="product-description">Wildflower wedding bouquet</p>
                        <div class="product-price">$68.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="14">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=14">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 15 -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product15">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Birthday</span>
                        <img src="https://i.pinimg.com/1200x/7f/1b/2c/7f1b2cbcc6506c49fbf400ee6aa959d8.jpg" class="img-fluid" alt="Pink Perfection">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Pink Perfection</h3>
                        <p class="product-description">Beautiful pink roses</p>
                        <div class="product-price">$43.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="15">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=15">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 16 -->
            <div class="col-lg-4 col-md-6 col-sm-12 " id="product16">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Sympathy</span>
                        <img src="https://i.pinimg.com/1200x/71/7b/5d/717b5d330a748b9feeec13412a33a930.jpg" class="img-fluid" alt="Peaceful Memorial">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Peaceful Memorial</h3>
                        <p class="product-description">White lilies arrangement</p>
                        <div class="product-price">$56.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="16">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=16">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div> 
                </div> 
            </div> 

            <!-- Product 17 - Autumn Harvest -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product17">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Thank You</span>
                        <img src="https://i.pinimg.com/1200x/3a/ab/86/3aab86b1fdaf97452871baa0a78e996c.jpg" class="img-fluid" alt="Autumn Harvest">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Autumn Harvest</h3>
                        <p class="product-description">Warm fall colors</p>
                        <div class="product-price">$44.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="17">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=17">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 18 - Garden Delight -->
            <div class="col-lg-4 col-md-6 col-sm-12" id="product18">
                <div class="product-card">
                    <div class="product-media">
                        <span class="occasion-badge">Just Because</span>
                        <img src="https://i.pinimg.com/1200x/64/04/4b/64044b909d2c59c63c376ccd94edf772.jpg" class="img-fluid" alt="Garden Delight">
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-title">Garden Delight</h3>
                        <p class="product-description">Mixed garden flowers</p>
                        <div class="product-price">$37.99</div>
                        <div class="product-actions">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="18">
                                <button type="submit" class="btn-add">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>

                            <a class="btn-details" href="product_details.php?id=18">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 


   
    </div>

    <!-- ================= FOOTER ================= -->
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
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="common.js"></script>
  
</body>

</html>