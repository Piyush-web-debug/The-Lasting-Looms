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
    <title>Payment - The Lasting Looms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="scripts.js"></script>
    <script defer src="cart.js"></script>
    <style>
        .payment-container {
            background: #f8f9fa;
            min-height: 100vh;
            padding: 40px 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .card-header {
            background: #007bff;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .order-summary {
            background: white;
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            background: #f8f9fa;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .cart-item-details {
            flex: 1;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .item-price {
            color: #28a745;
            font-weight: bold;
        }

        .summary-total {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 15px 15px;
            font-size: 1.1rem;
        }

        .payment-form {
            padding: 30px;
        }

        .form-group label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn-pay {
            background: #28a745;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-pay:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .payment-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .payment-icons img {
            height: 30px;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }

        .payment-icons img:hover {
            opacity: 1;
        }

        .payment-method {
            text-align: center;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method:hover {
            border-color: #007bff;
            transform: translateY(-2px);
        }

        .payment-method.active {
            border-color: #007bff;
            background-color: #f8f9fa;
        }

        .cart-item-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .cart-item-card img {
            max-height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }

        .price {
            color: #28a745;
            font-weight: bold;
            font-size: 1.1rem;
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
                        <a class="nav-link" href="about.php" style="color: #fff;">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php" style="color: #fff;">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" style="color: #fff;">Cart</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php" style="color: #fff;">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link" style="color: #fff;">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="payment-container">
        <div class="container">
            <h1 class="text-center mb-5">Complete Your Purchase</h1>

            <!-- Order Summary Section - Full Width -->
            <div class="card order-summary mb-4">
                <div class="card-header">
                    <h2><i class="fas fa-shopping-cart mr-2"></i>Order Summary</h2>
                </div>
                <div class="card-body">
                    <div class="row" id="cart-items">
                        <!-- Cart items will be dynamically generated in 3x3 grid -->
                    </div>
                    <div class="summary-total mt-4">
                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span id="subtotal">₹0.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Shipping:</span>
                                    <span>₹50.00</span>
                                </div>
                                <div class="d-flex justify-content-between font-weight-bold">
                                    <span>Total:</span>
                                    <span id="total-amount">₹0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Methods Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2><i class="fas fa-credit-card mr-2"></i>Select Payment Method</h2>
                </div>
                <div class="card-body">
                    <div class="row payment-methods">
                        <div class="col-md-3 payment-method" data-method="card">
                            <i class="fas fa-credit-card fa-2x mb-2"></i>
                            <h4>Credit/Debit Card</h4>
                        </div>
                        <div class="col-md-3 payment-method" data-method="upi">
                            <i class="fas fa-mobile-alt fa-2x mb-2"></i>
                            <h4>UPI Payment</h4>
                        </div>
                        <div class="col-md-3 payment-method" data-method="netbanking">
                            <i class="fas fa-university fa-2x mb-2"></i>
                            <h4>Net Banking</h4>
                        </div>
                        <div class="col-md-3 payment-method" data-method="wallet">
                            <i class="fas fa-wallet fa-2x mb-2"></i>
                            <h4>Wallet</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details Section -->
            <div class="payment-details">
                <!-- Card Form -->
                <div class="card payment-form card-details" id="card-form">
                    <div class="card-header">
                        <h2><i class="fas fa-credit-card mr-2"></i>Payment Details</h2>
                    </div>
                    <div class="payment-form">
                        <form action="payment_process.php" method="POST" id="payment-form">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control" name="card_number" placeholder="1234 5678 9012 3456" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input type="text" class="form-control" name="expiry" placeholder="MM/YY" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CVV</label>
                                        <input type="text" class="form-control" name="cvv" placeholder="123" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Card Holder Name</label>
                                <input type="text" class="form-control" name="card_holder" required>
                            </div>
                            <button type="submit" class="btn btn-pay btn-block mt-4">
                                Order placed successfully <i class="fas fa-lock ml-2"></i>
                            </button>
                        </form>
                        <div class="payment-icons">
                            <img src="images/visa.png" alt="Visa">
                            <img src="images/mastercard.png" alt="Mastercard">
                            <img src="images/amex.png" alt="American Express">
                        </div>
                    </div>
                </div>

                <!-- UPI Form -->
                <div class="card payment-form upi-details" id="upi-form" style="display:none;">
                    <div class="card-header">
                        <h2>UPI Payment</h2>
                    </div>
                    <div class="card-body">
                        <form action="payment_process.php" method="POST">
                            <div class="form-group">
                                <label>UPI ID</label>
                                <input type="text" class="form-control" name="upi_id" placeholder="username@upi" required>
                            </div>
                            <input type="hidden" name="payment_method" value="upi">
                            <input type="hidden" name="total_amount" class="total-amount-input">
                            <button type="submit" class="btn btn-pay btn-block">Pay with UPI</button>
                        </form>
                    </div>
                </div>

                <!-- Net Banking Form -->
                <div class="card payment-form netbanking-details" id="netbanking-form" style="display:none;">
                    <div class="card-header">
                        <h2>Net Banking</h2>
                    </div>
                    <div class="card-body">
                        <form action="payment_process.php" method="POST">
                            <div class="form-group">
                                <label>Select Bank</label>
                                <select class="form-control" name="bank" required>
                                    <option value="">Choose your bank</option>
                                    <option value="sbi">State Bank of India</option>
                                    <option value="hdfc">HDFC Bank</option>
                                    <option value="icici">ICICI Bank</option>
                                    <option value="axis">Axis Bank</option>
                                </select>
                            </div>
                            <input type="hidden" name="payment_method" value="netbanking">
                            <input type="hidden" name="total_amount" class="total-amount-input">
                            <button type="submit" class="btn btn-pay btn-block">Pay with Net Banking</button>
                        </form>
                    </div>
                </div>

                <!-- Wallet Form -->
                <div class="card payment-form wallet-details" id="wallet-form" style="display:none;">
                    <div class="card-header">
                        <h2>Wallet Payment</h2>
                    </div>
                    <div class="card-body">
                        <form action="payment_process.php" method="POST">
                            <div class="form-group">
                                <label>Select Wallet</label>
                                <select class="form-control" name="wallet" required>
                                    <option value="">Choose your wallet</option>
                                    <option value="paytm">Paytm</option>
                                    <option value="phonepe">PhonePe</option>
                                    <option value="gpay">Google Pay</option>
                                </select>
                            </div>
                            <input type="hidden" name="payment_method" value="wallet">
                            <input type="hidden" name="total_amount" class="total-amount-input">
                            <button type="submit" class="btn btn-pay btn-block">Pay with Wallet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-4" style="background-color: #343a40; color: #fff; padding: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Explore</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Home</a></li>
                        <li><a href="product.php" class="text-white">Products</a></li>
                        <li><a href="about.php" class="text-white">About</a></li>
                        <li><a href="contact.php" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li>Email: support@thelastinglooms.com</li>
                        <li>Phone: +91 123 456 7890</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Facebook</a></li>
                        <li><a href="#" class="text-white">Instagram</a></li>
                        <li><a href="#" class="text-white">Twitter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get cart items from localStorage
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            const cartContainer = document.getElementById('cart-items');
            const subtotalElement = document.getElementById('subtotal');
            const totalAmountElement = document.getElementById('total-amount');
            
            let subtotal = 0;
            const shippingCost = 50.00;

            // Display cart items
            cartItems.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                const itemElement = document.createElement('div');
                itemElement.className = 'cart-item';
                itemElement.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    <div class="cart-item-details">
                        <h4 class="item-name">${item.name}</h4>
                        <p>Quantity: ${item.quantity}</p>
                        <p class="item-price">₹${itemTotal.toFixed(2)}</p>
                    </div>
                `;
                cartContainer.appendChild(itemElement);
            });

            // Update totals
            subtotalElement.textContent = `₹${subtotal.toFixed(2)}`;
            const total = subtotal + shippingCost;
            totalAmountElement.textContent = `₹${total.toFixed(2)}`;

            // Add total to form
            const paymentForm = document.getElementById('payment-form');
            const totalInput = document.createElement('input');
            totalInput.type = 'hidden';
            totalInput.name = 'total_amount';
            totalInput.value = total.toFixed(2);
            paymentForm.appendChild(totalInput);

            // Add cart items to form
            const cartItemsInput = document.createElement('input');
            cartItemsInput.type = 'hidden';
            cartItemsInput.name = 'cart_items';
            cartItemsInput.value = JSON.stringify(cartItems);
            paymentForm.appendChild(cartItemsInput);

            // Payment method switching
            const paymentMethods = document.querySelectorAll('.payment-method');
            const paymentForms = {
                'card': document.getElementById('card-form'),
                'upi': document.getElementById('upi-form'),
                'netbanking': document.getElementById('netbanking-form'),
                'wallet': document.getElementById('wallet-form')
            };

            paymentMethods.forEach(method => {
                method.addEventListener('click', () => {
                    // Remove active class from all methods
                    paymentMethods.forEach(m => m.classList.remove('active'));
                    // Add active class to selected method
                    method.classList.add('active');
                    
                    // Hide all payment forms
                    Object.values(paymentForms).forEach(form => {
                        if (form) form.style.display = 'none';
                    });
                    
                    // Show selected payment form
                    const selectedMethod = method.getAttribute('data-method');
                    if (paymentForms[selectedMethod]) {
                        paymentForms[selectedMethod].style.display = 'block';
                    }
                });
            });

            // Set total amount in all payment forms
            const totalAmount = document.getElementById('total-amount').textContent;
            document.querySelectorAll('.total-amount-input').forEach(input => {
                input.value = totalAmount;
            });
        });

        const paymentMethods = document.querySelectorAll('.payment-method');
        const paymentDetails = document.querySelectorAll('.payment-details > div');
        const payNowBtn = document.getElementById('pay-now-btn');
        const paymentPopup = document.getElementById('payment-popup');
        const closePopupBtn = document.getElementById('close-popup-btn');
        const popupOverlay = document.getElementById('popup-overlay');

        paymentMethods.forEach(method => {
            method.addEventListener('click', () => {
                paymentMethods.forEach(m => m.classList.remove('active'));
                method.classList.add('active');
                paymentDetails.forEach(detail => detail.classList.remove('active'));
                document.querySelector(`.${method.dataset.method}-details`).classList.add('active');
            });
        });

        payNowBtn.addEventListener('click', (e) => {
            e.preventDefault();
            paymentPopup.style.display = 'block';
            popupOverlay.style.display = 'block';
        });

        closePopupBtn.addEventListener('click', () => {
            paymentPopup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });

        // Update the cart items display function
        function displayCartItems(items) {
            const container = document.getElementById('cart-items');
            container.innerHTML = '';
            
            items.forEach(item => {
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-4';
                col.innerHTML = `
                    <div class="cart-item-card">
                        <img src="${item.image}" alt="${item.name}" class="img-fluid mb-2">
                        <h5>${item.name}</h5>
                        <p>Quantity: ${item.quantity}</p>
                        <p class="price">₹${(item.price * item.quantity).toFixed(2)}</p>
                    </div>
                `;
                container.appendChild(col);
            });
        }

        // Add payment method selection handling
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', () => {
                // Remove active class from all methods
                document.querySelectorAll('.payment-method').forEach(m => 
                    m.classList.remove('active'));
                // Add active class to selected method
                method.classList.add('active');
                
                // Hide all payment forms
                document.querySelectorAll('.payment-form').forEach(form => 
                    form.style.display = 'none');
                
                // Show selected payment form
                const selectedForm = document.querySelector(
                    `.${method.dataset.method}-details`);
                if (selectedForm) {
                    selectedForm.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
