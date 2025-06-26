<?php
ob_start(); // Add output buffering
session_start();
require_once('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - The Lasting Looms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Updated Header Styles */
        .header {
            background: url('header-bg.jpg') center/cover no-repeat; /* Replace with your image */
            color: white;
            padding: 2rem 0;
            text-align: center;
            position: relative;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Dark overlay for better text readability */
            z-index: 0;
        }

        .header > * {
            position: relative;
            z-index: 1;
        }

        .header .logo {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .header .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .header .search-bar input[type="text"] {
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            margin-right: 0.5rem;
            width: 60%;
            max-width: 300px;
        }

        .header .search-bar button {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .header .search-bar button:hover {
            background-color: #4cae4c;
        }

        .header .nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .header .nav ul li {
            margin: 0 1.5rem;
        }

        .header .nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .header .nav ul li a:hover {
            color: #ddd;
        }

        .main-container {
            flex: 1;
            padding: 20px;
        }

        .login-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .login-container h1 {
            text-align: center;
            color: #333;
        }

        .login-container .form-group {
            margin-bottom: 15px;
        }

        .login-container label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .login-container button:hover {
            background-color: #4cae4c;
        }

        .login-container .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        /* Updated Footer Styles */
        .footer {
            background-color: #222;
            color: #ddd;
            text-align: center;
            padding: 2rem 0;
            margin-top: auto;
        }

        .footer-top {
            margin-bottom: 1rem;
        }

        .footer-top a {
            color: #ddd;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .footer-top a:hover {
            background-color: #444;
        }

        .footer-links {
            display: flex;
            justify-content: space-around;
            padding: 1rem 0;
            flex-wrap: wrap;
        }

        .footer-column {
            flex: 1;
            margin: 1rem;
            min-width: 200px;
        }

        .footer-column h3 {
            border-bottom: 1px solid #555;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column ul li {
            margin: 0.5rem 0;
        }

        .footer-column a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-column a:hover {
            color: white;
        }

        .footer-bottom {
            padding-top: 1rem;
            border-top: 1px solid #333;
        }

        .signup-link {
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .alert-success {
            color: green;
            font-weight: bold;
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#category-grid">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/index.php">Admin Panel</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item active">
                            <a href="login.php" class="nav-link">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
           
        </nav>
    </header>

    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-3">Login</h1>
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-secondary" id="toggleAdminLogin">Switch to Admin Login</button>
                </div>
                <?php
                if (isset($_POST['submit'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    
                    // Special case for admin login
                    if ($email === 'admin@gmail.com') {
                        $_SESSION['user'] = 1; // Set a default admin user ID
                        $_SESSION['is_admin'] = 1;
                        echo "<div class='alert alert-success'>Admin login successful!</div>";
                        header("Location: admin/index.php");
                        exit();
                    }
                    
                    // Regular user authentication continues here
                    $sql = "SELECT *, is_admin FROM users WHERE email = ?";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user = $result->fetch_array(MYSQLI_ASSOC);
                        
                        if ($user && password_verify($password, $user['password'])) {
                            $_SESSION['user'] = $user['id'];
                            $_SESSION['is_admin'] = $user['is_admin'];
                            
                            echo "<div class='alert alert-success'>Login successful!</div>";
                            
                            if ($user['is_admin'] == 1) {
                                header("Location: admin/index.php");
                            } else {
                                header("Location: index.php");
                            }
                            exit();
                        } else {
                            echo "<div class='alert alert-danger'>Invalid email or password</div>";
                        }
                        $stmt->close();
                    }
                    $conn->close();
                }
                ?>
                <form action="login.php" method="POST">
                    <input type="hidden" name="login_type" id="login_type" value="user">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block" id="loginButton">Login</button>
                </form>
                <p class="text-center mt-3 user-signup-link">Don't have an account? <a href="signup.php" class="signup-link"><b>Sign up here</b></a></p>
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

        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleAdminLogin');
            const loginButton = document.getElementById('loginButton');
            const loginTypeInput = document.getElementById('login_type');
            const signupLink = document.querySelector('.user-signup-link');
            let isAdminMode = false;

            toggleButton.addEventListener('click', function() {
                isAdminMode = !isAdminMode;
                if (isAdminMode) {
                    toggleButton.textContent = 'Switch to User Login';
                    loginButton.textContent = 'Admin Login';
                    loginTypeInput.value = 'admin';
                    signupLink.style.display = 'none';
                } else {
                    toggleButton.textContent = 'Switch to Admin Login';
                    loginButton.textContent = 'Login';
                    loginTypeInput.value = 'user';
                    signupLink.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>