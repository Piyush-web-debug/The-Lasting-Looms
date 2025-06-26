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
    <title>Contact Us - The Lasting Looms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="script.js"></script>
    <style>
        .contact-page {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .contact-info {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        .contact-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .contact-form h2 {
            color: #343a40;
        }
        .btn-primary {
            background-color: #343a40;
            border-color: #343a40;
        }
        .btn-primary:hover {
            background-color: #495057;
            border-color: #495057;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header bg-dark text-white">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">The Lasting Looms</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" style="color: #fff;">Cart</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['user'])): ?>
                            <a href="logout.php" class="nav-link" style="color: #fff;">Logout</a>
                        <?php else: ?>
                            <a href="login.php" class="nav-link" style="color: #fff;">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="contact-page container my-5">
        <section class="contact-info text-center mb-5">
            <h1>Contact Us</h1>
            <p>Mobile no: 7977677xxx / 82917546xx</p>
            <p>Email: piyushpan123@gmail.com / niteshkandekar@gmail.com</p>
        </section>

        <section class="contact-form">
            <h2 class="text-center mb-4">Get in Touch</h2>
            <form action="send_message.php" method="POST" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        <div class="invalid-feedback">
                            Please provide your name.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                    <div class="invalid-feedback">
                        Please provide a message.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Message</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-4">
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
                        <li><a href="#" class="text-white" style="color: #fff;">Help Center</li>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Bootstrap form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        document.addEventListener('DOMContentLoaded', () => {
            const searchButton = document.querySelector('.search-bar button');
            const searchInput = document.querySelector('.search-bar input');

            const performSearch = () => {
                const query = searchInput.value.toLowerCase();
                window.location.href = `product.php?search=${encodeURIComponent(query)}`;
            };

            searchButton.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', (event) => {
                if (event.key === 'Enter') {
                    performSearch();
                }
            });
        });
    </script>
</body>
</html>


