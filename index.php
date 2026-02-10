<?php
session_start();
require"config.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bloomify - Flower Arrangements</title>

    <!-- SEO Essentials -->
    <meta
      name="description"
      content="Luxury flower arrangements with same-day delivery. Discover Bloomify's premium bouquets for all occasions."
    />
    <meta
      name="keywords"
      content="flowers, bouquets, roses, delivery, gifts, arrangements"
    />

    <!-- External Libraries -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap"
      rel="stylesheet"
    />

    <!-- Main Styles -->
    <link rel="stylesheet" href="index.css" />
  </head>

  <body>

<!-- ================= NAVBAR ================= -->
<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-flower1"></i> Bloomify
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto nav-center">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
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

            <ul class="navbar-nav ms-lg-auto">
                <!-- Account Dropdown -->
                <li class="nav-item dropdown">
                    <button class="icon-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Account Menu">
                        <i class="bi bi-person"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end account-dropdown">
                        <li><a class="dropdown-item" href="loginn.php"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                        <li><a class="dropdown-item" href="register.php"><i class="bi bi-person-plus"></i> Register</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="orders.php"><i class="bi bi-bag-check"></i> My Orders</a></li>
                        <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear"></i> Settings</a></li>
                    </ul>
                </li>

                <!-- Cart Button -->
                <li class="nav-item">
          <button class="icon-btn position-relative border-0 bg-transparent" onclick="window.location.href='cart.php'">
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

 <!-- ================= HERO SECTION ================= -->
<section class="hero-section full-screen-hero d-flex align-items-center justify-content-center" id="home" style="min-height: 100vh; padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8 text-center">
        <div class="hero-overlay-content">
          <p class="hero-badge-small mb-3 d-inline-block">
            New: Custom Design Your Perfect Bouquet
          </p>
          <h1 class="hero-title display-4 display-md-3 display-lg-2 mb-3">
            Exquisite Flowers, Designed Your Way
          </h1>
          <p class="hero-subtitle lead mb-4 px-3 px-md-5">
            Choose from ready arrangements or create your own masterpiece – delivered same day.
          </p>

          <div class="hero-actions d-flex flex-column flex-sm-row justify-content-center gap-3 mt-4 mt-md-5 px-3">
            <button
              class="btn-primary-custom btn-lg-hero"
              onclick="window.location.href='Products.php'"
            >
              <i class="bi bi-basket3 me-2"></i>
              <span class="d-none d-sm-inline">Browse Ready Arrangements</span>
              <span class="d-inline d-sm-none">Browse Shop</span>
            </button>

            <a href="customize.php" class="btn-secondary-hero">
              <i class="bi bi-palette me-2"></i>
              <span class="d-none d-sm-inline">Create Custom Design</span>
              <span class="d-inline d-sm-none">Customize</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= FEATURED PRODUCTS ================= -->
<section class="featured-section" id="products">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Trending Right Now</h2>
        </div>

        <div id="productsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">
                
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-card">
                                <div class="product-media">
                                    <span class="occasion-badge">Anniversary</span>
                                    <img src="https://i.pinimg.com/1200x/d2/8a/62/d28a62936363ac3f40f15cdbeff9045a.jpg" alt="Rose Bouquet" />
                                </div>
                                <div class="product-card-body">
                                    <h3 class="product-title">Classic Rose Elegance</h3>
                                    <p class="product-description">A timeless arrangement of premium red roses</p>
                                    <div class="product-price">$45.99</div>
                                    <div class="product-actions">
                                        <form method="post" action="add_to_cart.php">
                                            <input type="hidden" name="id" value="1">
                                            <button class="btn-add" type="submit">
                                                <i class="bi bi-cart-plus"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                        <a class="btn-details" href="product_details.php?id=1">
                                            <i class="bi bi-eye"></i>
                                            <span>Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-card">
                                <div class="product-media">
                                    <span class="occasion-badge">Birthday</span>
                                    <img src="https://i.pinimg.com/736x/a8/63/ac/a863ac5e0c1adb2c90be3f7e05493f2b.jpg" alt="Spring Mix" />
                                </div>
                                <div class="product-card-body">
                                    <h3 class="product-title">Spring Garden Mix</h3>
                                    <p class="product-description">Vibrant seasonal flowers in a rustic basket</p>
                                    <div class="old-price">$48.99</div>
<div class="product-price sale-price">$38.99</div>
                                    <div class="product-actions">
                                        <form method="post" action="add_to_cart.php">
                                            <input type="hidden" name="id" value="2">
                                            <button class="btn-add" type="submit">
                                                <i class="bi bi-cart-plus"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                        <a class="btn-details" href="product_details.php?id=2">
                                            <i class="bi bi-eye"></i>
                                            <span>Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-card">
                                <div class="product-media">
                                    <span class="occasion-badge">Wedding</span>
                                    <img src="https://i.pinimg.com/736x/7a/53/aa/7a53aa225ddb4a0995610ad6785a9c71.jpg" alt="Luxury Bouquet" />
                                </div>
                                <div class="product-card-body">
                                    <h3 class="product-title">Luxury Peonies</h3>
                                    <p class="product-description">Exquisite pink peonies with eucalyptus</p>
                                    <div class="product-price">$65.99</div>
                                    <div class="product-actions">
                                        <form method="post" action="add_to_cart.php">
                                            <input type="hidden" name="id" value="3">
                                            <button class="btn-add" type="submit">
                                                <i class="bi bi-cart-plus"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                        <a class="btn-details" href="product_details.php?id=3">
                                            <i class="bi bi-eye"></i>
                                            <span>Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-card">
                                <div class="product-media">
                                    <span class="occasion-badge">Birthday</span>
                                    <img src="https://i.pinimg.com/1200x/de/36/88/de3688c5aeec84964b0c770da5bdd555.jpg" alt="Sunflower arrangement" />
                                </div>
                                <div class="product-card-body">
                                    <h3 class="product-title">Sunny Bouquet</h3>
                                    <p class="product-description">Bright sunflowers with greenery</p>
                                    <div class="product-price">$34.99</div>
                                    <div class="product-actions">
                                        <form method="post" action="add_to_cart.php">
                                            <input type="hidden" name="id" value="6">
                                            <button class="btn-add" type="submit">
                                                <i class="bi bi-cart-plus"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                        <a class="btn-details" href="product_details.php?id=6">
                                            <i class="bi bi-eye"></i>
                                            <span>Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-card">
                                <div class="product-media">
                                    <span class="occasion-badge">Romance</span>
                                    <img src="https://i.pinimg.com/736x/de/f6/fb/def6fbf7b056a64091a2619aa9cdbeaf.jpg" alt="Tulip Mix" />
                                </div>
                                <div class="product-card-body">
                                    <h3 class="product-title">Tulip Dreams</h3>
                                    <p class="product-description">Elegant tulip arrangement</p>
                                    <div class="product-price">$42.99</div>
                                    <div class="product-actions">
                                        <form method="post" action="add_to_cart.php">
                                            <input type="hidden" name="id" value="4">
                                            <button class="btn-add" type="submit">
                                                <i class="bi bi-cart-plus"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                        <a class="btn-details" href="product_details.php?id=4">
                                            <i class="bi bi-eye"></i>
                                            <span>Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-card">
                                <div class="product-media">
                                    <span class="occasion-badge">Special</span>
                                    <img src="https://i.pinimg.com/736x/a8/63/ac/a863ac5e0c1adb2c90be3f7e05493f2b.jpg" alt="Mixed Flowers" />
                                </div>
                                <div class="product-card-body">
                                    <h3 class="product-title">Garden Delight</h3>
                                    <p class="product-description">Colorful mixed arrangement</p>
                                    <div class="product-price">$39.99</div>
                                    <div class="product-actions">
                                        <form method="post" action="add_to_cart.php">
                                            <input type="hidden" name="id" value="5">
                                            <button class="btn-add" type="submit">
                                                <i class="bi bi-cart-plus"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                        <a class="btn-details" href="product_details.php?id=5">
                                            <i class="bi bi-eye"></i>
                                            <span>Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <!-- View All Button -->
        <div class="view-all-wrapper">
            <a href="Products.php" class="btn-view-all">
                <i class="bi bi-box-seam"></i>
                <span>View All Products</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>


    <!-- ================= OCCASIONS ================= -->
    <section class="occasions-section" id="occasions">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="section-title">Shop by Occasion</h2>
          <p class="subtitle">
            Find the perfect arrangements for every special moment.
          </p>
        </div>

        <div
          id="occasionsCarousel"
          class="carousel slide"
          data-bs-ride="carousel"
          data-bs-interval="4000"
        >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row g-4">
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=Birthday"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-balloon-heart"></i>
                      </div>
                      <div class="occasion-name">Birthday</div>
                    </div>
                  </a>
                </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=Wedding"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-heart"></i>
                      </div>
                      <div class="occasion-name">Wedding</div>
                    </div>
                  </a>
                </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=Anniversary"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-gift"></i>
                      </div>
                      <div class="occasion-name">Anniversary</div>
                    </div>
                  </a>
                </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=Graduation"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-mortarboard"></i>
                      </div>
                      <div class="occasion-name">Graduation</div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="row g-4">
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=Valentine"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-heart-fill"></i>
                      </div>
                      <div class="occasion-name">Valentine's Day</div>
                    </div>
                  </a>
                </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=GetWell"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-emoji-smile"></i>
                      </div>
                      <div class="occasion-name">Get Well Soon</div>
                    </div>
                  </a>
                </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=ThankYou"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-hand-thumbs-up"></i>
                      </div>
                      <div class="occasion-name">Thank You</div>
                    </div>
                  </a>
                </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=NewBaby"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-bag-heart"></i>
                      </div>
                      <div class="occasion-name">New Baby</div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="row g-4">
<div class="col-lg-3 col-md-4 col-sm-6 col-6">                  <a
                    href="Products.php?occasion=Sympathy"
                    class="occasion-card-link"
                  >
                    <div class="occasion-card">
                      <div class="occasion-icon">
                        <i class="bi bi-flower1"></i>
                      </div>
                      <div class="occasion-name">Sympathy & Funeral</div>
                    </div>
                  </a>
                </div>

<div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <a href="Products.php" class="occasion-card-link">
                    <div class="occasion-card occasion-card-shop">
                      <div class="occasion-icon">
                        <i class="bi bi-shop"></i>
                      </div>
                      <div class="occasion-name">Shop All Products</div>
                    </div>
                  </a>
                </div>
<div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <a href="#contact" class="occasion-card-link">
                    <div class="occasion-card occasion-card-contact">
                      <div class="occasion-icon">
                        <i class="bi bi-telephone"></i>
                      </div>
                      <div class="occasion-name">Contact Us</div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <button
            class="carousel-control-prev occasion-carousel-prev"
            type="button"
            data-bs-target="#occasionsCarousel"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button
            class="carousel-control-next occasion-carousel-next"
            type="button"
            data-bs-target="#occasionsCarousel"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon"></span>
          </button>

         
        </div>
      </div>
    </section>

    <!-- ================= WHY CHOOSE US ================= -->
    <section class="why-section">
      <div class="container">
        <h2 class="section-title text-center mb-5">Why Choose Us?</h2>

        <div class="row g-4">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="feature-card">
              <div class="feature-icon"><i class="bi bi-truck"></i></div>
              <h4 class="feature-title">Fast Delivery</h4>
              <p class="feature-description">
                Same-day delivery available in most areas.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="feature-card">
              <div class="feature-icon"><i class="bi bi-award"></i></div>
              <h4 class="feature-title">Premium Quality</h4>
              <p class="feature-description">
                Freshly picked flowers from top-rated suppliers.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="feature-card">
              <div class="feature-icon"><i class="bi bi-palette"></i></div>
              <h4 class="feature-title">Creative Designs</h4>
              <p class="feature-description">
                Unique arrangements crafted by floral experts.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="feature-card">
              <div class="feature-icon"><i class="bi bi-box-seam"></i></div>
              <h4 class="feature-title">Elegant Packaging</h4>
              <p class="feature-description">
                Beautiful presentation for every single order.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ================= TESTIMONIALS SECTION ================= -->
    <section class="testimonials-section">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="section-title">What Our Customers Say</h2>
          <p class="section-subtitle">
            Real reviews from real customers who love our flowers
          </p>
        </div>

        <div class="row g-4">
          <!-- Testimonial 1 -->
<div class="col-lg-4 col-md-6 col-sm-12">
              <div class="testimonial-card">
              <div class="quote-icon">
                <i class="bi bi-quote"></i>
              </div>
              <div class="stars mb-3">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="testimonial-text">
                "The flowers were absolutely stunning! Delivered on time and
                lasted for over a week. My wife was so happy with her
                anniversary bouquet. Highly recommend Bloomify!"
              </p>
              <div class="customer-info">
                <div class="customer-avatar">
                  <i class="bi bi-person-circle"></i>
                </div>
                <div class="customer-details">
                  <h5 class="customer-name">Michael Johnson</h5>
                  <p class="customer-occasion">Anniversary Roses</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Testimonial 2 -->
<div class="col-lg-4 col-md-6 col-sm-12">
              <div class="testimonial-card">
              <div class="quote-icon">
                <i class="bi bi-quote"></i>
              </div>
              <div class="stars mb-3">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="testimonial-text">
                "Beautiful arrangements and excellent customer service! I
                ordered a birthday bouquet and it exceeded my expectations. The
                quality is amazing. Will definitely order again!"
              </p>
              <div class="customer-info">
                <div class="customer-avatar">
                  <i class="bi bi-person-circle"></i>
                </div>
                <div class="customer-details">
                  <h5 class="customer-name">Sarah Williams</h5>
                  <p class="customer-occasion">Birthday Bouquet</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Testimonial 3 -->
<div class="col-lg-4 col-md-6 col-sm-12">
              <div class="testimonial-card">
              <div class="quote-icon">
                <i class="bi bi-quote"></i>
              </div>
              <div class="stars mb-3">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="testimonial-text">
                "Perfect for our wedding! The floral arrangements were elegant
                and fresh. The team was professional and delivered everything on
                time. Thank you Bloomify!"
              </p>
              <div class="customer-info">
                <div class="customer-avatar">
                  <i class="bi bi-person-circle"></i>
                </div>
                <div class="customer-details">
                  <h5 class="customer-name">David & Emma</h5>
                  <p class="customer-occasion">Wedding Flowers</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ================= FAQ SECTION ================= -->
    <section class="faq-section" id="FAQ">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="section-title">Frequently Asked Questions</h2>
          <p class="section-subtitle">
            Everything you need to know about ordering flowers
          </p>
        </div>

        <div class="row justify-content-center">
<div class="col-lg-8 col-md-10 col-sm-12">
              <div class="accordion" id="faqAccordion">
              <!-- Question 1 -->
              <div class="accordion-item faq-item">
                <h3 class="accordion-header">
                  <button
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faq1"
                  >
                    <i class="bi bi-question-circle me-3"></i>
                    Do you offer same-day delivery?
                  </button>
                </h3>
                <div
                  id="faq1"
                  class="accordion-collapse collapse show"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    Yes! We offer same-day delivery for orders placed before 2
                    PM in most areas. Our express delivery service ensures your
                    flowers arrive fresh and on time for any special occasion.
                  </div>
                </div>
              </div>

              <!-- Question 2 -->
              <div class="accordion-item faq-item">
                <h3 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faq2"
                  >
                    <i class="bi bi-question-circle me-3"></i>
                    Can I customize my bouquet?
                  </button>
                </h3>
                <div
                  id="faq2"
                  class="accordion-collapse collapse"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    Absolutely! We offer custom arrangements tailored to your
                    preferences. Contact us with your color scheme, flower
                    types, and occasion, and our expert florists will create the
                    perfect bouquet for you.
                  </div>
                </div>
              </div>

              <!-- Question 3 -->
              <div class="accordion-item faq-item">
                <h3 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faq3"
                  >
                    <i class="bi bi-question-circle me-3"></i>
                    How long will the flowers stay fresh?
                  </button>
                </h3>
                <div
                  id="faq3"
                  class="accordion-collapse collapse"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    With proper care, our premium flowers typically last 7-14
                    days. We provide care instructions with every order,
                    including tips on water changes, temperature, and placement
                    to maximize the lifespan of your arrangement.
                  </div>
                </div>
              </div>

              <!-- Question 4 -->
              <div class="accordion-item faq-item">
                <h3 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faq4"
                  >
                    <i class="bi bi-question-circle me-3"></i>
                    What if the flowers arrive damaged?
                  </button>
                </h3>
                <div
                  id="faq4"
                  class="accordion-collapse collapse"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    We guarantee 100% freshness and quality. If your flowers
                    arrive damaged or you're not completely satisfied, contact
                    us within 24 hours and we'll send a replacement or provide a
                    full refund. Your satisfaction is our priority!
                  </div>
                </div>
              </div>

              <!-- Question 5 -->
              <div class="accordion-item faq-item">
                <h3 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faq5"
                  >
                    <i class="bi bi-question-circle me-3"></i>
                    Can I add a personal message or gift?
                  </button>
                </h3>
                <div
                  id="faq5"
                  class="accordion-collapse collapse"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    Yes! You can add a free personalized card message during
                    checkout. We also offer add-ons like chocolates, teddy
                    bears, and gift baskets to make your delivery extra special.
                  </div>
                </div>
              </div>

              <!-- Question 6 -->
              <div class="accordion-item faq-item">
                <h3 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faq6"
                  >
                    <i class="bi bi-question-circle me-3"></i>
                    What payment methods do you accept?
                  </button>
                </h3>
                <div
                  id="faq6"
                  class="accordion-collapse collapse"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    We accept all major credit cards (Visa, Mastercard, American
                    Express), PayPal, and Apple Pay. All payments are processed
                    securely through encrypted connections.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact CTA -->
        <div class="text-center mt-5">
          <p class="faq-cta-text">Still have questions?</p>
          <a href="contact.html" class="btn-faq-contact">
            <i class="bi bi-envelope"></i>
            Contact Us
          </a>
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
   
<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="common.js"></script>

<script>
var NAVBAR_ID = "mainNavbar";

function handleScroll() {
    var navbar = document.querySelector('.navbar');
    var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    
    if (!navbar) return;

    if (currentScroll > 100) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
}

window.addEventListener('scroll', handleScroll);

window.addEventListener('scroll', handleScroll);
</script>




</body>
</html>
</body>
</html>