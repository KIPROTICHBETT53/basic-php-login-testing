<?php
session_start(); // Start the session to access session variables
require 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch products
$sql = "SELECT ProductID, ProductName, Price, Description FROM products LIMIT 5"; // Adjust LIMIT as needed
$result = $conn->query($sql);

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce App</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Link to CSS file -->
</head>
<body>
    <header>
        <h1>Welcome to the E-Commerce App</h1>
        <nav>
            <?php if (isset($_SESSION['username'])): ?>
                <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p> <!-- Use htmlspecialchars for security -->
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a> |
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>

<main>
    <h2>Featured Products</h2>
    <p>Explore our exclusive products and great deals!</p>
    <?php
    // Example of fetching products from the database (adjust based on your database structure)
    require 'db_connection.php';
    $sql = "SELECT ProductID, ProductName, Price, Description FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<h3>" . htmlspecialchars($row['ProductName']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['Description']) . "</p>";
            echo "<p>Price: $" . htmlspecialchars($row['Price']) . "</p>";
            echo "<a href='order.php?product_id=" . $row['ProductID'] . "'>Order</a>"; // Order link
            echo "</div>";
        }
    } else {
        echo "<p>No products available.</p>";
    }
    ?>
</main>


    <footer>
        <p>&copy; 2024 E-Commerce App. All rights reserved.</p>
    </footer>
</body>
</html>
