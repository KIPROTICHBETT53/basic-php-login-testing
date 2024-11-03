<?php
session_start(); // Start the session to access session variables
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
        <!-- You can add product listings here -->
    </main>

    <footer>
        <p>&copy; 2024 E-Commerce App. All rights reserved.</p>
    </footer>
</body>
</html>
