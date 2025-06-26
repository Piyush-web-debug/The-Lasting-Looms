<?php
session_start();
require_once('database.php');
require_once('config/razorpay.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $razorpay_signature = $_POST['razorpay_signature'];

    // Verify signature
    $generated_signature = hash_hmac('sha256', $razorpay_order_id . '|' . $razorpay_payment_id, "RAZORPAY_KEY_SECRET");
    
    if ($generated_signature === $razorpay_signature) {
        // Payment successful, save order details
        $user_id = $_SESSION['user'];
        $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        foreach ($cart_items as $item) {
            $sql = "INSERT INTO sales (user_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iidd", $user_id, $item['id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        // Clear cart
        unset($_SESSION['cart']);

        // Show success message
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Payment Success</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-5 text-center">
                <h1 class="text-success">Payment Successful!</h1>
                <p>Your order has been placed successfully.</p>
                <p>Transaction ID: ' . htmlspecialchars($razorpay_payment_id) . '</p>
                <a href="index.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        </body>
        </html>';
    }
}
?>
