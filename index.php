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

        <div class="product-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-item">
                    <h3><?php echo htmlspecialchars($row['ProductName']); ?></h3>
                    <p><?php echo htmlspecialchars($row['Description']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars($row['Price']); ?></p>
                    <a href="product_detail.php?id=<?php echo $row['ProductID']; ?>">View Details</a>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 E-Commerce App. All rights reserved.</p>
    </footer>
</body>
</html>
