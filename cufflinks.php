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
    <title>Cufflinks - The Lasting Looms</title>
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
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="products">
        <div class="container">
            <h1 class="my-4">Cufflinks</h1>
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
                                        <option value="Silver">Silver</option>
                                        <option value="Gold">Gold</option>
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
                        <img src="cufflinks/71ugU17McCL._AC_UY1100_FMwebp_.webp" 
                            alt="Cufflink 1" 
             onerror="this.onerror=null;this.src='cufflinks/cufflink1.jpg';">
        
        <h2>Silver Cufflinks</h2>
        <p>Elegant silver cufflinks for a refined look.</p>
        <p class="price">₹99.99</p>
        <a href="cart.php" class="btn buy-now" data-id="silver_cufflinks" data-name="Silver Cufflinks" data-price="99.99" data-image="cufflinks/71ugU17McCL._AC_UY1100_FMwebp_.webp">Buy Now</a>
        <div class="quantity-controls">
            <button class="minus-btn">-</button>
            <input type="number" value="1" min="1" class="quantity-input">
            <button class="plus-btn">+</button>
        </div>
    </div>

                <div class="product-item">
                    <img src="cufflinks/BIAB0119C17_YAA18DIG6XXXXXXXX_ABCD00-PICS-00004-1024-38267.webp" alt="Cufflink 2" onerror="this.onerror=null;this.src='cufflinks/cufflink2.jpg';">
                    <h2>Gold Cufflinks</h2>
                    <p>Luxurious gold cufflinks for special occasions.</p>
                    <p class="price">₹899.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="gold_cufflinks" data-name="Gold Cufflinks" data-price="899.99" data-image="cufflinks/BIAB0119C17_YAA18DIG6XXXXXXXX_ABCD00-PICS-00004-1024-38267.webp">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/BIAB0119C16_YAA18DIG6XXXXXXXX_ABCD00-PICS-00004-1024-38251.webp" alt="Cufflink 2" onerror="this.onerror=null;this.src='cufflinks/cufflink2.jpg';">
                    <h2>Gold Cufflinks</h2>
                    <p>Luxurious gold cufflinks for special occasions.</p>
                    <p class="price">₹849.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="gold_cufflinks_2" data-name="Gold Cufflinks" data-price="849.99" data-image="cufflinks/BIAB0119C16_YAA18DIG6XXXXXXXX_ABCD00-PICS-00004-1024-38251.webp">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <!-- Add more products as needed -->
                <div class="product-item">
                    <img src="cufflinks/61dQdqZqSiL._AC_UY1100_FMwebp_.webp" alt="Cufflink 3" onerror="this.onerror=null;this.src='cufflinks/cufflink3.jpg';">
                    <h2>Classic Cufflinks</h2>
                    <p>Timeless classic cufflinks for any occasion.</p>
                    <p class="price">₹399.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="classic_cufflinks" data-name="Classic Cufflinks" data-price="399.99" data-image="cufflinks/61dQdqZqSiL._AC_UY1100_FMwebp_.webp">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/DSC_4069_copy.jpg" alt="Cufflink 4" onerror="this.onerror=null;this.src='cufflinks/cufflink4.jpg';">
                    <h2>Modern Cufflinks</h2>
                    <p>Stylish modern cufflinks for a contemporary look.</p>
                    <p class="price">₹499.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="modern_cufflinks" data-name="Modern Cufflinks" data-price="499.99" data-image="cufflinks/DSC_4069_copy.jpg">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/81dRO7MbVfL._AC_UY1100_FMwebp_.webp" alt="Cufflink 5" onerror="this.onerror=null;this.src='cufflinks/cufflink5.jpg';">
                    <h2>Designer Cufflinks</h2>
                    <p>Exclusive designer cufflinks for a unique style.</p>
                    <p class="price">₹699.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="designer_cufflinks" data-name="Designer Cufflinks" data-price="699.99" data-image="cufflinks/81dRO7MbVfL._AC_UY1100_FMwebp_.webp">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/rn-image_picker_lib_temp_bcb90813-4456-4be4-82b2-a6d8c26d26a3_576x.jpg" alt="Cufflink 6" onerror="this.onerror=null;this.src='cufflinks/cufflink6.jpg';">
                    <h2>Personalized Cufflinks</h2>
                    <p>Customizable cufflinks for a personal touch.</p>
                    <p class="price">₹749.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="personalized_cufflinks" data-name="Personalized Cufflinks" data-price="749.99" data-image="cufflinks/rn-image_picker_lib_temp_bcb90813-4456-4be4-82b2-a6d8c26d26a3_576x.jpg">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/NH_CFL_03_f0e254b4_thumbnail_1024.webp" alt="Cufflink 7" onerror="this.onerror=null;this.src='cufflinks/cufflink7.jpg';">
                    <h2>Gemstone Cufflinks</h2>
                    <p>Elegant gemstone cufflinks for a luxurious look.</p>
                    <p class="price">₹899.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="gemstone_cufflinks" data-name="Gemstone Cufflinks" data-price="899.99" data-image="cufflinks/NH_CFL_03_f0e254b4_thumbnail_1024.webp">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/SS42_fad658dd-11f3-4d37-ba5b-af705d57cfa5_288x.jpeg" alt="Cufflink 7" onerror="this.onerror=null;this.src='cufflinks/cufflink7.jpg';">
                    <h2>Gemstone Cufflinks</h2>
                    <p>Elegant gemstone cufflinks for a luxurious look.</p>
                    <p class="price">₹849.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="gemstone_cufflinks_2" data-name="Gemstone Cufflinks" data-price="849.99" data-image="cufflinks/SS42_fad658dd-11f3-4d37-ba5b-af705d57cfa5_288x.jpeg">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/CufflinksstampsAnandPrakash_700x.jpg" alt="Cufflink 8" onerror="this.onerror=null;this.src='cufflinks/cufflink8.jpg';">
                    <h2>Vintage Cufflinks</h2>
                    <p>Classic vintage cufflinks for a timeless appeal.</p>
                    <p class="price">₹249.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="vintage_cufflinks" data-name="Vintage Cufflinks" data-price="249.99" data-image="cufflinks/CufflinksstampsAnandPrakash_700x.jpg">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/Untitleddesign_6_700x.png" alt="Cufflink 9" onerror="this.onerror=null;this.src='cufflinks/cufflink9.jpg';">
                    <h2>Novelty Cufflinks</h2>
                    <p>Fun novelty cufflinks for a unique statement.</p>
                    <p class="price">₹549.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="novelty_cufflinks" data-name="Novelty Cufflinks" data-price="549.99" data-image="cufflinks/Untitleddesign_6_700x.png">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/DSC0276.jpg" alt="Cufflink 10" onerror="this.onerror=null;this.src='cufflinks/cufflink10.jpg';">
                    <h2>Luxury Cufflinks</h2>
                    <p>Premium luxury cufflinks for special occasions.</p>
                    <p class="price">₹999.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="luxury_cufflinks" data-name="Luxury Cufflinks" data-price="999.99" data-image="cufflinks/DSC0276.jpg">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/51wN7bRMKqL._AC_UY1100_FMwebp_.webp" alt="Cufflink 11" onerror="this.onerror=null;this.src='cufflinks/cufflink11.jpg';">
                    <h2>Wooden Cufflinks</h2>
                    <p>Unique wooden cufflinks for a natural look.</p>
                    <p class="price">₹149.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="wooden_cufflinks" data-name="Wooden Cufflinks" data-price="149.99" data-image="cufflinks/51wN7bRMKqL._AC_UY1100_FMwebp_.webp">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/9_e29bcaf4-2347-4482-b89e-6936bf500f07.jpg" alt="Cufflink 12" onerror="this.onerror=null;this.src='cufflinks/cufflink12.jpg';">
                    <h2>Enamel Cufflinks</h2>
                    <p>Colorful enamel cufflinks for a vibrant style.</p>
                    <p class="price">₹799.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="enamel_cufflinks" data-name="Enamel Cufflinks" data-price="799.99" data-image="cufflinks/9_e29bcaf4-2347-4482-b89e-6936bf500f07.jpg">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <div class="product-item">
                    <img src="cufflinks/2_33770f1f-0813-4be3-b98f-80c1ec3a34cc.jpg" alt="Cufflink 12" onerror="this.onerror=null;this.src='cufflinks/cufflink12.jpg';">
                    <h2>Enamel Cufflinks</h2>
                    <p>Colorful enamel cufflinks for a vibrant style.</p>
                    <p class="price">₹549.99</p>
                    <a href="cart.php" class="btn buy-now" data-id="enamel_cufflinks_2" data-name="Enamel Cufflinks" data-price="549.99" data-image="cufflinks/2_33770f1f-0813-4be3-b98f-80c1ec3a34cc.jpg">Buy Now</a>
                    <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="plus-btn">+</button>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
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
            const productGrid = document.querySelector('.product-grid');
            const itemsArray = Array.from(productItems);

            itemsArray.sort((a, b) => {
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

            itemsArray.forEach(item => productGrid.appendChild(item));
        }

        priceFilter.addEventListener('change', filterProducts);
        typeFilter.addEventListener('change', filterProducts);
        sortFilter.addEventListener('change', filterProducts);

        filterProducts();
    });
</script>
    
    </body>
</html>
