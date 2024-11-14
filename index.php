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
    require 'db_connection.php';
    $sql = "SELECT ProductID, ProductName, Price, Stock, Description FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<ul>';
        while($row = $result->fetch_assoc()) {
            echo '<li>';
            echo '<h3>' . htmlspecialchars($row["ProductName"]) . '</h3>';
            echo '<p>Price: $' . htmlspecialchars($row["Price"]) . '</p>';
            echo '<p>Stock: ' . htmlspecialchars($row["Stock"]) . '</p>';
            echo '<p>' . htmlspecialchars($row["Description"]) . '</p>';
            echo '<a href="orders.php?ProductID=' . htmlspecialchars($row["ProductID"]) . '">Order</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No products available at the moment.</p>';
    }
    ?>
</main>



    <footer>
        <p>&copy; 2024 E-Commerce App. All rights reserved.</p>
    </footer>
</body>
</html>
