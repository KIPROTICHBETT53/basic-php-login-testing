<?php
session_start();
require 'db_connection.php';

if (!isset($_GET['ProductID'])) {
    echo "Product ID not provided!";
    exit;
}

$productID = $_GET['ProductID'];
$sql = "SELECT ProductName, Price, Stock, Description FROM products WHERE ProductID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo "<h2>Order for " . htmlspecialchars($product['ProductName']) . "</h2>";
    echo "<p>Price: $" . htmlspecialchars($product['Price']) . "</p>";
    echo "<p>Description: " . htmlspecialchars($product['Description']) . "</p>";

    // Order form here
    echo '<form method="POST" action="process_order.php">';
    echo '<label for="quantity">Quantity:</label>';
    echo '<input type="number" name="quantity" min="1" max="' . htmlspecialchars($product['Stock']) . '" required>';
    echo '<input type="hidden" name="ProductID" value="' . htmlspecialchars($productID) . '">';
    echo '<button type="submit">Place Order</button>';
    echo '</form>';
} else {
    echo "Product not found!";
}
?>
