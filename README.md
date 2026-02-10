# 🌸 Bloomify - Flower Arrangement E-Commerce Platform



## 📋 Project Overview

Bloomify is a modern, elegant e-commerce platform for flower arrangements and custom bouquet design. Built with PHP, MySQL, and Bootstrap, it provides a seamless shopping experience for customers looking to purchase beautiful floral arrangements for any occasion.

### ✨ Key Features

- **🛍️ Product Catalog**: Browse through a wide variety of pre-designed flower arrangements
- **🎨 Custom Bouquet Designer**: Create personalized bouquets by selecting individual flowers
- **🛒 Shopping Cart**: Full cart management with quantity controls
- **📦 Order Management**: Complete order tracking from placement to delivery
- **👤 User Authentication**: Secure registration and login system
- **🎯 Occasion-Based Filtering**: Find perfect arrangements for specific occasions
- **📱 Responsive Design**: Fully mobile-friendly interface
- **💳 Checkout System**: Streamlined order processing

---

## 🚀 Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **CSS Framework**: Bootstrap 5.3.0
- **Icons**: Bootstrap Icons
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Fonts**: Google Fonts (Playfair Display, Lato)

---

## 📦 Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP/MAMP (for local development)

### Step-by-Step Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/bloomify.git
   cd bloomify
   ```

2. **Import the database**
   ```bash
   # Using MySQL command line
   mysql -u your_username -p newschema < database.sql
   
   # Or import through phpMyAdmin:
   # - Open phpMyAdmin
   # - Create database 'newschema'
   # - Import database.sql file
   ```

3. **Configure database connection**
   ```bash
   # Copy the example config file
   cp config_example.php config.php
   
   # Edit config.php with your database credentials
   nano config.php
   ```

4. **Update config.php**
   ```php
   <?php
   $host = "localhost";
   $user = "your_database_username";
   $password = "your_database_password";
   $db = "newschema";
   
   $conn = new mysqli($host, $user, $password, $db);
   
   if($conn->connect_error)
       die("Connection failed: " . $conn->connect_error);
   ?>
   ```

5. **Start your web server**
   - **XAMPP**: Place project in `htdocs/bloomify`
   - **WAMP**: Place project in `www/bloomify`
   - Access via: `http://localhost/bloomify`

---

## 📁 Project Structure

```
bloomify/
│
├── index.php                 # Homepage with featured products
├── Products.php              # Product catalog page
├── product_details.php       # Individual product details
├── customize.php             # Custom bouquet designer
├── cart.php                  # Shopping cart
├── checkout.php              # Checkout page
├── orders.php                # User orders list
├── order-details.php         # Detailed order view
│
├── loginn.php                # Login page
├── register.php              # Registration page
├── forgotPassword.php        # Password recovery
│
├── add_to_cart.php          # Add item to cart handler
├── update_cart.php          # Update cart quantities
├── remove_from_cart.php     # Remove from cart handler
├── clear_cart.php           # Clear entire cart
├── process_order.php        # Order processing handler
├── cancel-order.php         # Order cancellation handler
│
├── config.php               # Database configuration
├── config_example.php       # Example configuration
├── database.sql             # Database schema
│
├── index.css                # Main stylesheet
├── products.css             # Products page styles
├── product_details.css      # Product details styles
├── cart.css                 # Cart page styles
├── checkout.css             # Checkout styles
├── orders.css               # Orders page styles
├── order-details.css        # Order details styles
├── customize.css            # Custom designer styles
├── auth.css                 # Authentication pages styles
│
├── common.js                # Shared JavaScript functions
├── auth.js                  # Authentication scripts
├── login.js                 # Login page scripts
├── register.js              # Registration scripts
├── forgotPassword.js        # Password recovery scripts
├── cart.js                  # Cart functionality
├── checkout.js              # Checkout scripts
└── order-details.js         # Order details scripts
```

---

## 🗄️ Database Schema

### Main Tables

- **`customers`** - User accounts and authentication
- **`arrangements`** - Pre-designed flower arrangements
- **`flowers`** - Individual flower types for custom orders
- **`categories`** - Product categories
- **`occasions`** - Special occasions (Birthday, Wedding, etc.)
- **`orders`** - Customer orders
- **`order_arrangements`** - Items in standard orders
- **`custom_order_flowers`** - Items in custom orders
- **`arrangement_flowers`** - Flower composition of arrangements
- **`arrangement_occasions`** - Occasions linked to arrangements

---

## 🎨 Features Breakdown

### 1. **Product Browsing**
- Featured products carousel on homepage
- Filterable product catalog
- Search by name, category, or occasion
- Price range filtering
- Sort by price or name

### 2. **Custom Bouquet Designer**
- Select individual flower types
- Specify quantities
- Real-time price calculation
- Stock availability checking
- Direct checkout for custom orders

### 3. **Shopping Cart**
- Add/remove items
- Update quantities
- Real-time price updates
- Persistent cart (session-based)
- Support for both pre-made and custom orders

### 4. **Order Management**
- Complete order history
- Order status tracking
- Detailed order views
- Order cancellation
- Delivery information

### 5. **User Authentication**
- Secure registration with validation
- Email-based login
- Password recovery system
- Session management

---

## 🎯 User Roles

Currently, the system supports **Customer** role with these capabilities:
- Browse products
- Create custom bouquets
- Place orders
- Track order status
- Manage profile

*(Admin panel not included in current version)*

---

## 🔒 Security Features

- Password validation (min 8 chars, uppercase, lowercase, numbers)
- Email validation
- SQL injection prevention through prepared statements
- Session-based authentication
- HTTPS ready

---

## 🌐 Browser Support

- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)
- ✅ Mobile browsers

---

## 📱 Responsive Design

The application is fully responsive with breakpoints for:
- 📱 Mobile: < 576px
- 📱 Tablet: 576px - 992px
- 💻 Desktop: > 992px

---

## 🚧 Known Limitations

- Payment processing is placeholder only (Cash on Delivery)
- No admin dashboard
- No email notifications
- Session-based cart (not persistent across devices)

---

## 🔮 Future Enhancements

- [ ] Admin dashboard for product/order management
- [ ] Multiple payment gateway integration
- [ ] Email notifications for order updates
- [ ] Wishlist functionality
- [ ] Product reviews and ratings
- [ ] Advanced search with filters
- [ ] User profile management
- [ ] Order history export
- [ ] Discount codes and promotions

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---


## 👤 Author
Bloomify Team

- GitHub: [Re831-lab] 
- Email: rasha.2005zreaq@gmail.com


---

## 🙏 Acknowledgments

- Bootstrap for the responsive framework
- Bootstrap Icons for beautiful icons
- Google Fonts for typography
- Pinterest for placeholder images

---



**Made with ❤️ and 🌸 by Bloomify Team**