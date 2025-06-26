<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="scripts.js"></script>
    <script defer src="cart.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Header Styles */
        .header {
            background-color: #343a40 !important;
            color: #fff !important;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 2rem;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            margin-left: 1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #f0f0f0 !important;
        }

        /* Hero Section Styles */
        .hero {
            background: #3498db;
            color: #fff;
            text-align: center;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.25rem;
        }

        /* Main Content Styles */
        .container {
            margin-top: 2rem;
        }

        .filters {
            background-color: #fff;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .filters h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .filter-group {
            margin-bottom: 1rem;
        }

        .filter-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            font-size: 1rem;
        }

        .cart-items {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        /* Enhanced Cart Item Styles */
        .cart-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 100%;
            height: auto;
            margin-bottom: 1rem;
            object-fit: cover;
            border-radius: 5px;
        }

        .cart-item h2 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #333;
            text-align: center;
        }

        .cart-item p {
            margin-bottom: 0.5rem;
            color: #666;
            text-align: center;
        }

        .cart-item .price {
            font-weight: bold;
            color: #28a745;
            text-align: center;
        }

        /* Improved Quantity Controls */
        .quantity-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 0.5rem;
        }

        .quantity-controls button {
            padding: 0.25rem 0.5rem;
            border: none;
            background-color: #6c757d;
            color: #fff;
            cursor: pointer;
            border-radius: 0.25rem;
            transition: background-color 0.3s;
        }

        .quantity-controls button:hover {
            background-color: #5a6268;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            margin: 0 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .remove-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
            margin-top: 0.5rem;
        }

        .remove-button:hover {
            background-color: #c82333;
        }

        .cart-summary {
            background-color: #fff;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-summary h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .cart-summary p {
            margin-bottom: 0.5rem;
        }

        .checkout-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 1.1rem;
            width: 100%;
            transition: background-color 0.3s;
        }

        .checkout-button:hover {
            background-color: #218838;
        }

        /* Empty Cart Message Styles */
        .empty-cart-message {
            text-align: center;
            padding: 2rem;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 2rem;
        }

        /* Footer Styles */
        .footer {
            background-color: #343a40 !important;
            color: #fff !important;
            padding: 2rem 0;
            text-align: center;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            color: #f0f0f0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header" style="background-color: #343a40; color: #fff;">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40;">
            <a class="navbar-brand" href="index.php" style="font-size: 2rem; color: #fff;">The Lasting Looms</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: #fff;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#category-grid" style="color: #fff;">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about" style="color: #fff;">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php" style="color: #fff;">Contact</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="cart.php" style="color: #fff;">Cart <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" style="background: #3498db; color: #fff; text-align: center; padding: 5rem 2rem;">
        <div class="hero-content">
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Your Shopping Cart</h1>
            <p style="font-size: 1.25rem; margin-bottom: 2rem;">Review your selected items and proceed to checkout when you're ready.</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <main class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="payment.php">
                    <div class="cart-items" id="cart-items">
                        <!-- Cart items will be dynamically inserted here -->
                    </div>
                    <input type="hidden" name="total-price" id="hidden-total-price" value="0.00">
                </form>
                <div class="cart-summary">
                    <h2>Summary</h2>
                    <p>Subtotal: <span id="subtotal">₹0.00</span></p>
                    <p>Shipping Cost: <span id="shipping-cost">₹50.00</span></p>
                    <p>Total Items: <span id="total-items">0</span></p>
                    <p>Total Price: ₹<span id="total-price">0.00</span></p>
                    <button type="button" class="btn btn-success checkout-button" onclick="window.location.href='payment.php'">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-4" style="background-color: #343a40; color: #fff; padding: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Explore</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white" style="color: #fff;">Home</a></li>
                        <li><a href="product.php" class="text-white" style="color: #fff;">Products</a></li>
                        <li><a href="contact.php" class="text-white" style="color: #fff;">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white" style="color: #fff;">Help Center</a></li>
                        <li><a href="#" class="text-white" style="color: #fff;">Shipping & Delivery</a></li>
                        <li><a href="#" class="text-white" style="color: #fff;">Returns & Exchanges</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Connect with Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white" style="color: #fff;">Facebook</a></li>
                        <li><a href="#" class="text-white" style="color: #fff;">Instagram</a></li>
                        <li><a href="#" class="text-white" style="color: #fff;">Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <p>&copy; 2024 The Lasting Looms. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateCartSummary();

            function updateCartSummary() {
                let subtotal = 0;
                const cartItems = document.querySelectorAll('.cart-item');
                cartItems.forEach(item => {
                    const price = parseFloat(item.querySelector('.price').textContent.replace('₹', ''));
                    const quantity = parseInt(item.querySelector('.quantity-input').value);
                    subtotal += price * quantity;
                });
                document.getElementById('subtotal').textContent = `₹${subtotal.toFixed(2)}`;
                const totalItems = cartItems.length;
                document.getElementById('total-items').textContent = totalItems;
                const shippingCost = 50.00;
                const totalPrice = subtotal + shippingCost;
                document.getElementById('total-price').textContent = totalPrice.toFixed(2);
                document.getElementById('hidden-total-price').value = totalPrice.toFixed(2);
            }

            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', updateCartSummary);
            });

            document.querySelectorAll('.remove-button').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.cart-item').remove();
                    updateCartSummary();
                });
            });
        });
    </script>
</body>
</html>

