<?php
require "config.php";
session_start();

if (!isset($_SESSION["customer_id"])) {
  header("Location: loginn.php");
  exit;
}

if (!isset($_GET['id'])) {
  header("Location: orders.php");
  exit;
}

$order_id = $_GET['id'];
$customer_id = $_SESSION["customer_id"];

$sql = "SELECT * FROM orders WHERE order_id = $order_id AND customer_id = $customer_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
  die("Order not found.");
}
$order = $result->fetch_assoc();

$items_sql = "SELECT oa.*, a.arrangement_name, a.image_url 
              FROM order_arrangements oa 
              JOIN arrangements a ON oa.arrangement_id = a.arrangement_id 
              WHERE oa.order_id = $order_id";
$items_result = $conn->query($items_sql);

$custom_items_sql = "SELECT cof.*, f.flower_name, f.image_url, f.unit_price 
                     FROM custom_order_flowers cof 
                     JOIN flowers f ON cof.flower_id = f.flower_id 
                     WHERE cof.order_id = $order_id";
$custom_items_result = $conn->query($custom_items_sql);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Details - Bloomify</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="order-details.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php"><i class="bi bi-flower1"></i> Bloomify</a>
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
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item" href="orders.php"><i class="bi bi-bag-check"></i> My Orders</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
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

  <div class="page-header-order">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="orders.php">My Orders</a></li>
          <li class="breadcrumb-item active">Order #BLM-<?php echo $order_id; ?></li>
        </ol>
      </nav>
      <h1 class="h3 h-md-2">Order #BLM-<?php echo $order_id; ?></h1>
      <p class="d-none d-sm-block">View your order details and track status</p>
    </div>
  </div>

  <section class="order-details-section">
    <div class="container">
      <div class="order-header-card">
        <div class="row align-items-center">
           <div class="col-12 col-sm-6 col-md-8">
            <h3 class="order-number h5 h-md-4">Order #BLM-<?php echo $order_id; ?></h3>
            <div class="order-meta">
              <span><i class="bi bi-calendar3"></i> <span class="d-none d-sm-inline">Placed on:</span> <?php echo $order['order_date']; ?></span>
            </div>
          </div>
       <div class="col-12 col-sm-6 col-md-4">
            <?php $status_class = strtolower(str_replace(' ', '-', $order['status'])); ?>
            <span class="status-badge <?php echo $status_class; ?>">
              <i class="bi bi-check-circle"></i> <?php echo $order['status']; ?>
            </span>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-12 col-sm-8 col-lg-8">

          <!-- Order Items Card -->
          <div class="detail-card">
            <div class="card-header-custom">
              <h4 class="h5"><i class="bi bi-basket3"></i> Order Items</h4>
            </div>
            <div class="card-body-custom">
              <?php
              $items_subtotal = 0;
              while ($item = $items_result->fetch_assoc()) {
                $row_total = $item['quantity'] * $item['unit_price'];
                $items_subtotal += $row_total;
              ?>
                <div class="order-item">
                  <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['arrangement_name']; ?>" class="item-image">
                  <div class="item-info">
                    <div class="item-name"><?php echo $item['arrangement_name']; ?></div>
                    <div class="item-details">Quantity: <?php echo $item['quantity']; ?></div>
                  </div>
                  <div class="item-price-section">
                    <div class="item-unit-price d-none d-sm-block">$ <?php echo $item['unit_price']; ?> each</div>
                    <div class="item-subtotal">$ <?php echo $row_total; ?></div>
                  </div>
                </div>
              <?php } ?>

              <?php
              if ($custom_items_result->num_rows > 0) {
                while ($c_item = $custom_items_result->fetch_assoc()) {
                  $row_total = $c_item['subtotal'];
                  $items_subtotal += $row_total;
              ?>
                  <div class="order-item custom-flower-item" style="background-color: #f9f9f9;">
                    <img src="<?php echo $c_item['image_url']; ?>" alt="<?php echo $c_item['flower_name']; ?>" class="item-image">
                    <div class="item-info">
                      <div class="item-name"><?php echo $c_item['flower_name']; ?> <span class="badge bg-info text-dark">Custom</span></div>
                      <div class="item-details">Quantity: <?php echo $c_item['quantity']; ?> stems</div>
                    </div>
                    <div class="item-price-section">
                      <div class="item-unit-price d-none d-sm-block">$ <?php echo $c_item['unit_price']; ?> each</div>
                      <div class="item-subtotal">$ <?php echo $row_total; ?></div>
                    </div>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>

          <!-- Delivery Information -->
          <div class="detail-card mt-4">
            <div class="card-header-custom">
              <h4 class="h5"><i class="bi bi-truck"></i> Delivery Information</h4>
            </div>
            <div class="card-body-custom">
              <div class="row g-3">
                <div class="col-12 col-sm-6">
                  <div class="info-box">
                    <i class="bi bi-calendar-check"></i>
                    <div>
                      <label>Delivery Date</label>
                      <span><?php echo $order['delivery_date']; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="info-box">
                    <i class="bi bi-clock-history"></i>
                    <div>
                      <label>Delivery Time</label>
                      <span><?php echo $order['delivery_time']; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="info-box">
                    <i class="bi bi-geo-alt"></i>
                    <div>
                      <label>Delivery Address</label>
                      <span><?php echo $order['delivery_address']; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="info-box">
                    <i class="bi bi-card-text"></i>
                    <div>
                      <label>Card Message</label>
                      <span><?php echo !empty($order['card_message']) ? $order['card_message'] : 'None'; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    <div>
                      <label>Special Instructions</label>
                      <span><?php echo !empty($order['special_instructions']) ? $order['special_instructions'] : 'None'; ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Order Tracking -->
          <div class="detail-card mt-4 d-none d-lg-block">
            <div class="card-header-custom">
              <h4 class="h5"><i class="bi bi-map"></i> Order Tracking</h4>
            </div>
            <div class="card-body-custom">
              <div class="tracking-timeline">
                <div class="timeline-item active">
                  <div class="timeline-icon"><i class="bi bi-check-circle-fill"></i></div>
                  <div class="timeline-content">
                    <h5>Order Placed</h5>
                    <p>Received</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
<div class="col-12 col-sm-4 col-lg-4">
          <div class="detail-card sticky-card">
            <div class="card-header-custom">
              <h4 class="h5"><i class="bi bi-receipt"></i> Payment Summary</h4>
            </div>
            <div class="card-body-custom">
              <div class="summary-row">
                <span>Items Total:</span>
                <span>$ <?php echo $items_subtotal; ?></span>
              </div>
              <div class="summary-row">
                <span>Delivery Fee:</span>
                <span>$ <?php echo $order['delivery_fee']; ?></span>
              </div>
              <div class="summary-row">
                <span>Discount:</span>
                <span class="text-success">-$ <?php echo $order['discount_amount']; ?></span>
              </div>
              <hr class="summary-divider" />
              <div class="summary-row summary-total">
                <span>Final Amount:</span>
                <span>$ <?php echo $order['total_amount']; ?></span>
              </div>
              <div class="payment-info mt-3">
                <div class="info-box">
                  <i class="bi bi-credit-card"></i>
                  <div><label>Payment Method</label><span><?php echo $order['payment_method']; ?></span></div>
                </div>
                <div class="info-box mt-2">
                  <i class="bi bi-check-circle"></i>
                  <div><label>Payment Status</label><span><?php echo $order['payment_status']; ?></span></div>
                </div>
              </div>
              <div class="action-buttons mt-4">
                <a href="orders.php" class="btn-action btn-primary w-100 mb-2" style="text-decoration: none;">
                  <i class="bi bi-arrow-left me-2"></i> 
                  <span class="d-none d-sm-inline">Back to Orders</span>
                  <span class="d-inline d-sm-none">Back</span>
                </a>
                <form method="POST" action="cancel-order.php" onsubmit="return confirm('Are you sure?');">
                  <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                  <button type="submit" class="btn-action btn-outline w-100">
                    <i class="bi bi-x-circle me-2"></i> Cancel Order
                  </button>
                </form>
              </div>
            </div>
          </div>

          <div class="detail-card mt-4">
            <div class="card-body-custom text-center">
              <i class="bi bi-headset help-icon"></i>
              <h5 class="mt-3 h6">Need Help?</h5>
              <p class="text-muted small">Contact our support team</p>
              <a href="#" class="btn-action btn-outline w-100">
                <i class="bi bi-telephone me-2"></i> 
                <span class="d-none d-sm-inline">Contact Support</span>
                <span class="d-inline d-sm-none">Support</span>
              </a>
            </div>
          </div>
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
  <script src="common.js"></script>
  <script src="order-details.js"></script>
</body>

</html>