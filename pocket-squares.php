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
    <title>Pocket Squares - The Lasting Looms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="scripts.js"></script>
    <style>
        /* Header Styles */
        .header {
            background-color: #343a40;
            color: #fff;
        }
        .navbar-dark {
            background-color: #343a40;
        }
        .navbar-brand {
            font-size: 2rem;
            color: #fff;
        }
        .nav-link {
            color: #fff !important;
        }

        /* Main Content Styles */
        .products {
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .my-4 {
            text-align: center;
        }
        .filters {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .filter-group {
            margin-bottom: 10px;
        }

        /* Product Grid Styles */
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .product-item {
            width: 300px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px; /* More rounded corners */
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
            transition: transform 0.3s ease; /* Add transition for hover effect */
        }

        .product-item:hover {
            transform: translateY(-5px); /* Slight lift on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Enhance shadow on hover */
        }

        .product-item img {
            width: 100%;
            height: 200px; /* Set a fixed height */
            object-fit: cover; /* Maintain aspect ratio and cover the area */
            border-radius: 8px;
            margin-bottom: 10px; /* Add spacing below image */
        }

        .product-item h2 {
            font-size: 1.3rem; /* Slightly larger font size */
            margin-top: 10px;
            color: #333; /* Darken heading text */
        }

        .product-item p {
            font-size: 1rem;
            color: #666; /* Slightly darker text */
            margin-bottom: 15px; /* Add spacing below description */
        }

        .btn.buy-now {
            display: inline-block;
            padding: 10px 15px; /* Adjusted padding */
            background-color: #5cb85c; /* Change to a more appealing green */
            color: #fff;
            text-decoration: none;
            border-radius: 8px; /* More rounded corners */
            transition: background-color 0.3s ease; /* Add transition for hover effect */
        }

        .btn.buy-now:hover {
            background-color: #4cae4c; /* Darker green on hover */
        }

        .quantity-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-controls button {
            border: none;
            background: none;
            font-size: 1.4rem; /* Slightly larger font size */
            color: #888; /* Gray color for buttons */
            cursor: pointer;
            transition: color 0.3s ease; /* Add transition for hover effect */
        }

        .quantity-controls button:hover {
            color: #666; /* Darker gray on hover */
        }

        .quantity-controls input {
            width: 50px; /* Slightly wider input */
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            margin: 0 5px;
        }

        /* Footer Styles */
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 2rem;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php">The Lasting Looms</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#category-grid">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.html">Cart</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="products">
        <div class="container">
            <h1 class="my-4">Pocket Squares</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="filters">
                        <h2>Filter by:</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="filter-group">
                                    <label for="price-filter">Price:</label>
                                    <select id="price-filter" class="form-control filter-select">
                                        <option value="all">All</option>
                                        <option value="0-100">₹0-₹100</option>
                                        <option value="100-200">₹100 - ₹200</option>
                                        <option value="200-400">₹200 - ₹400</option>
                                        <option value="400-600">₹400 - ₹600</option>
                                        <option value="600-800">₹600 - ₹800</option>
                                        <option value="800-1000">₹800 - ₹1000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="filter-group">
                                    <label for="color-filter">Type:</label>
                                    <select id="color-filter" class="form-control filter-select">
                                        <option value="all">All</option>
                                        <option value="Silk">Silk</option>
                                        <option value="Patterned">Patterned</option>
                                        <option value="Classic">Classic</option>
                                        <option value="Modern">Modern</option>
                                        <option value="Designer">Designer</option>
                                        <option value="Personalised">Personalised</option>
                                        <option value="Gemstone">Gemstone</option>
                                        <option value="Vintage">Vintage</option>
                                        <option value="Novelty">Novelty</option>
                                        <option value="Luxury">Luxury</option>
                                        <option value="Wooden">Wooden</option>
                                        <option value="Enamel">Enamel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="filter-group">
                                    <label for="sort-filter">Sort by:</label>
                                    <select id="sort-filter" class="form-control filter-select">
                                        <option value="default">Default</option>
                                        <option value="price-asc">Price: Low to High</option>
                                        <option value="price-desc">Price: High to Low</option>
                                        <option value="name-asc">Name: A to Z</option>
                                        <option value="name-desc">Name: Z to A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product-grid">
                        <div class="product-item">
                            <img src="cufflinks/TSDO3PSQ77_6_700x.jpg" alt="Pocket Square 1" onerror="this.onerror=null;this.src='pocket-squares/pocket-square1.jpg';">
                            <h2>Silk Pocket Square</h2>
                            <p>Elegant silk pocket square for a sophisticated look.</p>
                            <p class="price">₹99.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="silk_pocket_square" data-name="Silk Pocket Square" data-price="99.99" data-image="cufflinks/TSDO3PSQ77_6_700x.jpg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/81Y3meWa+bL._AC_UY1100_FMwebp_.webp" alt="Pocket Square 2" onerror="this.onerror=null;this.src='pocket-squares/pocket-square2.jpg';">
                            <h2>Patterned Pocket Square</h2>
                            <p>Stylish patterned pocket square for a modern touch.</p>
                            <p class="price">₹799.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="patterned_pocket_square" data-name="Patterned Pocket Square" data-price="799.99" data-image="cufflinks/81Y3meWa+bL._AC_UY1100_FMwebp_.webp">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/71ExBDgL6jL._AC_UY1100_FMwebp_.webp" alt="Pocket Square 3" onerror="this.onerror=null;this.src='pocket-squares/pocket-square3.jpg';">
                            <h2>Classic Pocket Square</h2>
                            <p>Timeless classic pocket square for any occasion.</p>
                            <p class="price">₹899.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="classic_pocket_square" data-name="Classic Pocket Square" data-price="899.99" data-image="cufflinks/71ExBDgL6jL._AC_UY1100_FMwebp_.webp">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/TPSQ392_2_700x.jpg" alt="Pocket Square 4" onerror="this.onerror=null;this.src='pocket-squares/pocket-square4.jpg';">
                            <h2>Modern Pocket Square</h2>
                            <p>Stylish modern pocket square for a contemporary look.</p>
                            <p class="price">₹599.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="modern_pocket_square" data-name="Modern Pocket Square" data-price="599.99" data-image="cufflinks/TPSQ392_2_700x.jpg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/TPSQ218_2_700x.jpg" alt="Pocket Square 5" onerror="this.onerror=null;this.src='pocket-squares/pocket-square5.jpg';">
                            <h2>Designer Pocket Square</h2>
                            <p>Exclusive designer pocket square for a unique style.</p>
                            <p class="price">₹499.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="designer_pocket_square" data-name="Designer Pocket Square" data-price="499.99" data-image="cufflinks/TPSQ218_2_700x.jpg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/images.jpeg" alt="Pocket Square 6" onerror="this.onerror=null;this.src='pocket-squares/pocket-square6.jpg';">
                            <h2>Personalized Pocket Square</h2>
                            <p>Customizable pocket square for a personal touch.</p>
                            <p class="price">₹299.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="personalized_pocket_square" data-name="Personalized Pocket Square" data-price="299.99" data-image="cufflinks/images.jpeg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/images (1).jpeg" alt="Pocket Square 7" onerror="this.onerror=null;this.src='pocket-squares/pocket-square7.jpg';">
                            <h2>Gemstone Pocket Square</h2>
                            <p>Elegant gemstone pocket square for a luxurious look.</p>
                            <p class="price">₹999.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="gemstone_pocket_square" data-name="Gemstone Pocket Square" data-price="999.99" data-image="cufflinks/images%20(1).jpeg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/images (2).jpeg" alt="Pocket Square 8" onerror="this.onerror=null;this.src='pocket-squares/pocket-square8.jpg';">
                            <h2>Vintage Pocket Square</h2>
                            <p>Classic vintage pocket square for a timeless appeal.</p>
                            <p class="price">₹199.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="vintage_pocket_square" data-name="Vintage Pocket Square" data-price="199.99" data-image="cufflinks/images%20(2).jpeg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/images (3).jpeg" alt="Pocket Square 9" onerror="this.onerror=null;this.src='pocket-squares/pocket-square9.jpg';">
                            <h2>Novelty Pocket Square</h2>
                            <p>Fun novelty pocket square for a unique statement.</p>
                            <p class="price">₹799.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="novelty_pocket_square" data-name="Novelty Pocket Square" data-price="799.99" data-image="cufflinks/images%20(3).jpeg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/TPSQ354_2_700x.jpg" alt="Pocket Square 10" onerror="this.onerror=null;this.src='pocket-squares/pocket-square10.jpg';">
                            <h2>Luxury Pocket Square</h2>
                            <p>Premium luxury pocket square for special occasions.</p>
                            <p class="price">₹699.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="luxury_pocket_square" data-name="Luxury Pocket Square" data-price="699.99" data-image="cufflinks/TPSQ354_2_700x.jpg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/images (4).jpeg" alt="Pocket Square 11" onerror="this.onerror=null;this.src='pocket-squares/pocket-square11.jpg';">
                            <h2>Wooden Pocket Square</h2>
                            <p>Unique wooden pocket square for a natural look.</p>
                            <p class="price">₹149.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="wooden_pocket_square" data-name="Wooden Pocket Square" data-price="149.99" data-image="cufflinks/images%20(4).jpeg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <div class="product-item">
                            <img src="cufflinks/-473Wx593H-465821307-black-MODEL.jpg" alt="Pocket Square 12" onerror="this.onerror=null;this.src='pocket-squares/pocket-square12.jpg';">
                            <h2>Enamel Pocket Square</h2>
                            <p>Colorful enamel pocket square for a vibrant style.</p>
                            <p class="price">₹399.99</p>
                            <a href="cart.php" class="btn buy-now" data-id="enamel_pocket_square" data-name="Enamel Pocket Square" data-price="399.99" data-image="cufflinks/-473Wx593H-465821307-black-MODEL.jpg">Buy Now</a>
                            <div class="quantity-controls">
                                <button class="minus-btn">-</button>
                                <input type="number" value="1" min="1" class="quantity-input">
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
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
        document.addEventListener('DOMContentLoaded', function() {
            const priceFilter = document.getElementById('price-filter');
            const typeFilter = document.getElementById('color-filter');
            const sortFilter = document.getElementById('sort-filter');
            const productItems = document.querySelectorAll('.product-item');

            function filterProducts() {
                const priceValue = priceFilter.value;
                const typeValue = typeFilter.value;
                const sortValue = sortFilter.value;

                productItems.forEach(item => {
                    const price = parseFloat(item.querySelector('.price').textContent.replace('₹', ''));
                    const type = item.querySelector('h2').textContent.toLowerCase();

                    let show = true;

                    if (priceValue !== 'all') {
                        const [min, max] = priceValue.split('-').map(Number);
                        if (price < min || price > max) {
                            show = false;
                        }
                    }

                    if (typeValue !== 'all' && !type.includes(typeValue.toLowerCase())) {
                        show = false;
                    }

                    item.style.display = show ? 'block' : 'none';
                });

                sortProducts(sortValue);
            }

            function sortProducts(sortValue) {
                const sortedItems = Array.from(productItems).sort((a, b) => {
                    const priceA = parseFloat(a.querySelector('.price').textContent.replace('₹', ''));
                    const priceB = parseFloat(b.querySelector('.price').textContent.replace('₹', ''));
                    const nameA = a.querySelector('h2').textContent.toLowerCase();
                    const nameB = b.querySelector('h2').textContent.toLowerCase();

                    if (sortValue === 'price-asc') {
                        return priceA - priceB;
                    } else if (sortValue === 'price-desc') {
                        return priceB - priceA;
                    } else if (sortValue === 'name-asc') {
                        return nameA.localeCompare(nameB);
                    } else if (sortValue === 'name-desc') {
                        return nameB.localeCompare(nameA);
                    } else {
                        return 0;
                    }
                });

                const productGrid = document.querySelector('.product-grid');
                productGrid.innerHTML = '';
                sortedItems.forEach(item => productGrid.appendChild(item));
            }

            priceFilter.addEventListener('change', filterProducts);
            typeFilter.addEventListener('change', filterProducts);
            sortFilter.addEventListener('change', filterProducts);
        });
    </script>
</body>
</html>
