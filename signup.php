<?php
session_start();

// Initialize the message variable
$message = "";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate password length
    if (strlen($password) < 8) {
        $message = "<div class='alert alert-danger'>Password must be at least 8 characters long</div>";
    } else {
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        require_once('database.php');

        // Check if email already exists
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $message = "<div class='alert alert-danger'>Email already exists</div>";
        } else {
            // Insert user into database
            $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $passwordHash);
            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>You are registered successfully</div>";
                header("Location: login.php");
                exit();
            } else {
                $message = "<div class='alert alert-danger'>Failed to register. Error: " . $stmt->error . "</div>";
            }
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - The Lasting Looms</title>
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

        .main-container {
            flex: 1;
            padding: 20px;
        }

        .signup-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .signup-container h1 {
            text-align: center;
            color: #333;
        }

        .signup-container .form-group {
            margin-bottom: 15px;
        }

        .signup-container label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .signup-container button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .signup-container button:hover {
            background-color: #4cae4c;
        }

        .signup-container .login-link {
            text-align: center;
            margin-top: 20px;
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
                <li class="nav-item">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="logout.php" class="nav-link" style="color: #fff;">Logout</a>
                    <?php else: ?>
                        <a href="login.php"  class="nav-link" style="color: #fff;">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-3">Sign Up</h1>
            <?php if ($message): ?>
                <!-- Display the message if it's set -->
                <?php echo $message; ?>
            <?php endif; ?>
            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Sign Up</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
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

</body>
</html>
