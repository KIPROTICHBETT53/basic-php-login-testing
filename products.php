<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Product List</h2>
        <?php
        session_start();

        error_reporting(E_ALL); // Enable all error reporting
        ini_set('display_errors', 1); // Display errors on the page

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }

        require 'db_connection.php';

        // Check if connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Attempt to retrieve products
        $sql = "SELECT ProductID, ProductName, Price, Stock, Description FROM products";
        $result = $conn->query($sql);

        if (!$result) {
            die("Error in SQL query: " . $conn->error);
        }

        // Display products
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h3>" . htmlspecialchars($row['ProductName']) . "</h3>";
                echo "<p class='price'>Price: $" . number_format($row['Price'], 2) . "</p>";
                echo "<p class='stock'>Stock: " . htmlspecialchars($row['Stock']) . "</p>";
                echo "<p>" . htmlspecialchars($row['Description']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No products available.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
