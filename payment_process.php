<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user'];
    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    
    $success = true;
    $conn->begin_transaction();

    try {
        foreach ($cart_items as $item) {
            // Insert into sales table with current timestamp
            $sql = "INSERT INTO sales (user_id, product_id, quantity, price, sale_date) 
                   VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)";
            $stmt = $conn->prepare($sql);
            
            $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
            $product_id = $item['id'];
            $price = $item['price'];
            
            if (!$stmt->bind_param("iidd", $user_id, $product_id, $quantity, $price)) {
                throw new Exception("Error binding parameters: " . $stmt->error);
            }
            
            if (!$stmt->execute()) {
                throw new Exception("Error executing query: " . $stmt->error);
            }

            // Update product stock (optional)
            $sql = "UPDATE products SET stock = stock - ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $quantity, $product_id);
            $stmt->execute();
        }

        $conn->commit();
        unset($_SESSION['cart']);

        // Simplified success message without order details
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Payment Success</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script>
                localStorage.removeItem("cart");
            </script>
            <style>
                .success-container {
                    max-width: 500px;
                    margin: 100px auto;
                    text-align: center;
                    padding: 30px;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
                .success-icon {
                    color: #28a745;
                    font-size: 48px;
                    margin-bottom: 20px;
                }
                .transaction-id {
                    color: #6c757d;
                    font-size: 0.9rem;
                    margin: 15px 0;
                }
            </style>
        </head>
        <body class="bg-light">
            <div class="container">
                <div class="success-container">
                    <i class="fas fa-check-circle success-icon"></i>
                    <h1 class="text-success">Payment Successful!</h1>
                    <p class="transaction-id">Transaction ID: '.uniqid().'</p>
                    <p>'.date('d M Y H:i:s').'</p>
                    <div class="mt-4">
                        <a href="profile.php" class="btn btn-primary">View Orders</a>
                        <a href="index.php" class="btn btn-secondary">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </body>
        </html>';

    } catch (Exception $e) {
        $conn->rollback();
        error_log("Payment error: " . $e->getMessage());
        echo '<div class="alert alert-danger">Error processing your order: ' . $e->getMessage() . '</div>';
    }

} else {
    header('Location: payment.php');
}
?>
