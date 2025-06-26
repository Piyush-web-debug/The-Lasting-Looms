<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user'];

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];

    $sql = "UPDATE users SET phone=?, address=?, city=?, state=?, pincode=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $phone, $address, $city, $state, $pincode, $user_id);
    $stmt->execute();
}

// Get user details
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile - The Lasting Looms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .profile-section {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            margin: 0 auto 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
        }

        .order-history {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
        }

        .order-history h3 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background: #007bff;
            color: white;
            border: none;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-update {
            background: #007bff;
            border: none;
            padding: 10px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn-update:hover {
            background: #0056b3;
        }

        .alert-success {
            border-left: 4px solid #28a745;
        }

        .profile-stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            padding: 20px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">The Lasting Looms</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#category-grid">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                <li class="nav-item active"><a class="nav-link" href="profile.php">Profile</a></li>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index.php">Admin Panel</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-section">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <?php echo strtoupper(substr($user['full_name'], 0, 1)); ?>
                        </div>
                        <h4><?php echo $user['full_name']; ?></h4>
                        <p class="text-muted"><?php echo $user['email']; ?></p>
                    </div>
                    
                    <div class="profile-stats">
                        <?php 
                        // Get total orders
                        $stmt = $conn->prepare("SELECT COUNT(*) as order_count, SUM(quantity * price) as total_spent FROM sales WHERE user_id = ?");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $stats = $stmt->get_result()->fetch_assoc();
                        ?>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo $stats['order_count'] ?? 0; ?></div>
                            <div class="stat-label">Orders</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">₹<?php echo number_format($stats['total_spent'] ?? 0, 2); ?></div>
                            <div class="stat-label">Total Spent</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="profile-section">
                    <h3><i class="fas fa-user-edit mr-2"></i>Profile Details</h3>
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-phone mr-2"></i>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $user['phone']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-map-marker-alt mr-2"></i>Pincode</label>
                                    <input type="text" name="pincode" class="form-control" value="<?php echo $user['pincode']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-home mr-2"></i>Address</label>
                            <textarea name="address" class="form-control" rows="3"><?php echo $user['address']; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-city mr-2"></i>City</label>
                                    <input type="text" name="city" class="form-control" value="<?php echo $user['city']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-map mr-2"></i>State</label>
                                    <input type="text" name="state" class="form-control" value="<?php echo $user['state']; ?>">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-update">Update Profile</button>
                    </form>
                </div>

                <!-- Order History Section -->
                <div class="order-history">
                    <h3><i class="fas fa-shopping-bag mr-2"></i>Recent Orders</h3>
                    <?php
                    // Updated query to show more product details
                    $sql = "SELECT p.*, s.quantity, s.price as sale_price, s.sale_date 
                            FROM sales s 
                            JOIN products p ON s.product_id = p.id 
                            WHERE s.user_id = ? 
                            ORDER BY s.sale_date DESC";
                    
                    try {
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $orders = $stmt->get_result();
                            
                            if ($orders->num_rows > 0): ?>
                                <div class="row">
                                    <?php while ($order = $orders->fetch_assoc()): ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <img src="<?php echo htmlspecialchars($order['image_url']); ?>" 
                                                     class="card-img-top" 
                                                     alt="<?php echo htmlspecialchars($order['name']); ?>"
                                                     style="height: 200px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo htmlspecialchars($order['name']); ?></h5>
                                                    <p class="card-text">
                                                        <span class="badge badge-info"><?php echo ucfirst($order['category']); ?></span>
                                                    </p>
                                                    <p class="card-text">
                                                        <small>Quantity: <?php echo $order['quantity']; ?></small><br>
                                                        <small>Price: ₹<?php echo number_format($order['sale_price'], 2); ?></small><br>
                                                        <small class="text-muted">
                                                            Ordered on: <?php echo date('d M Y', strtotime($order['sale_date'])); ?>
                                                        </small>
                                                    </p>
                                                    <a href="#" class="btn btn-sm btn-outline-primary buy-again" 
                                                       data-id="<?php echo $order['id']; ?>"
                                                       data-name="<?php echo htmlspecialchars($order['name']); ?>"
                                                       data-price="<?php echo $order['price']; ?>"
                                                       data-image="<?php echo htmlspecialchars($order['image_url']); ?>">
                                                        Buy Again
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle mr-2"></i>No orders found.
                                    <a href="index.php#category-grid" class="alert-link">Start shopping now!</a>
                                </div>
                            <?php endif;
                        }
                    } catch (Exception $e) {
                        error_log("Error in profile page: " . $e->getMessage());
                        echo "<div class='alert alert-danger'>Error loading orders: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white mt-5 p-4 text-center">
        &copy; 2021 The Lasting Looms. All Rights Reserved.
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.querySelectorAll('.buy-again').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productData = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: parseFloat(this.dataset.price),
                image: this.dataset.image
            };
            addToCart(productData.id, productData.name, productData.price, productData.image);
            alert('Product added to cart!');
        });
    });
    </script>
</body>
</html>
