<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login_signup";

// Create a connection using mysqli
$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
