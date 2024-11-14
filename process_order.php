<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // Fetch product details from the database
    $sql = "SELECT ProductName, Price FROM products WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product selected.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Place Order for <?php echo htmlspecialchars($product['ProductName']); ?></h2>
    <p>Price: $<?php echo htmlspecialchars($product['Price']); ?></p>

    <form method="POST" action="process_order.php">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
