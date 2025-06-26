<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Lasting Looms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="script.js"></script>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php" style="color: #fff;">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #fff;" onclick="scrollToCategoryGrid()">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" style="color: #fff;">About Us</a>
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
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/index.php" style="color: #fff;">Admin Panel</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link" style="color: #fff;">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link" style="color: #fff;">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
           
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" style="background: #3498db; color: #fff; text-align: center; padding: 5rem 2rem;">
        <div class="hero-content">
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Elevate Your Style</h1>
            <p style="font-size: 1.25rem; margin-bottom: 2rem;">Discover premium Ties, Cufflinks, and Pocket Squares.</p>
            <a href="index.php#category-grid" class="btn btn-light" style="padding: 1rem 2rem; font-size: 1.1rem; background-color: #e74c3c; color: #fff; border: none;">Explore Collection</a>
        </div>
        
    </section>

    <!-- Featured Categories -->
    <section id="category-grid" class="categories" style="padding: 3rem 2rem; text-align: center;">
        <h2 style="font-size: 2rem; margin-bottom: 1.5rem;">Featured Categories</h2>
        <div class="category-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem; padding: 0 2rem;">
            <a href="ties.php" class="category-card" style="background: #fff; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; transition: transform 0.3s, box-shadow 0.3s; overflow: hidden;">
                <img src="images\51jd8gZQm3L._AC_UY1100_FMwebp_.webp" alt="Ties" width="300" height="200" style="border-radius: 8px;">
                <h3 style="margin: 1rem 0; font-size: 1.5rem; color: #333;">Ties</h3>
                <p style="color: #555;">Explore our elegant collection of ties.</p>
            </a>
            <a href="cufflinks.php" class="category-card" style="background: #fff; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; transition: transform 0.3s, box-shadow 0.3s; overflow: hidden;">
                <img src="cufflinks\71ugU17McCL._AC_UY1100_FMwebp_.webp" alt="Cufflinks" width="300" height="200" style="border-radius: 8px;">
                <h3 style="margin: 1rem 0; font-size: 1.5rem; color: #333;">Cufflinks</h3>
                <p style="color: #555;">Add a touch of sophistication with our cufflinks.</p>
            </a>
            <a href="pocket-squares.php" class="category-card" style="background: #fff; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; transition: transform 0.3s, box-shadow 0.3s; overflow: hidden;">
                <img src="cufflinks\TSDO3PSQ77_6_700x.jpg" alt="Pocket Squares" width="300" height="200" style="border-radius: 8px;">
                <h3 style="margin: 1rem 0; font-size: 1.5rem; color: #333;">Pocket Squares</h3>
                <p style="color: #555;">Complete your look with our stylish pocket squares.</p>
            </a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-us" style="background: #f5f7fa; padding: 4rem 2rem; text-align: center;">
        <div class="about-content">
            <h2 style="font-size: 2rem; margin-bottom: 1.5rem; color: #333;">Our Story</h2>
            <p style="font-size: 1.25rem; color: #555;">The Lasting Looms was founded with a vision to provide premium accessories that embody elegance and sophistication.
            We believe that every detail matters, and our products are crafted with the finest materials and meticulous attention to detail.</p>
            <p style="font-size: 1.25rem; color: #555;">From classic designs to contemporary styles, our collection is curated to meet the diverse needs of our customers.
            We are committed to delivering exceptional quality and unparalleled customer service.</p>
        </div>
       
    </section>

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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function scrollToCategoryGrid() {
            const element = document.getElementById('category-grid');
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const searchButton = document.querySelector('.search-bar button');
            const searchInput = document.querySelector('.search-bar input');

            const performSearch = () => {
                const query = searchInput.value.toLowerCase();
                if (query.includes('tie')) {
                    window.location.href = `ties.php?search=${encodeURIComponent(query)}`;
                } else if (query.includes('cufflink')) {
                    window.location.href = `cufflinks.php?search=${encodeURIComponent(query)}`;
                } else if (query.includes('pocket square')) {
                    window.location.href = `pocket-squares.php?search=${encodeURIComponent(query)}`;
                } else {
                    window.location.href = `product.php?search=${encodeURIComponent(query)}`;
                }
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
