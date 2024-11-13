<?php
session_start();

require 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['ProductID'];
    $quantity = $_POST['Quantity'];

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (UserID, ProductID, Quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $userId, $productId, $quantity);

    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error placing order: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: products.php"); // Redirect back to products page
    exit;
}
?>
