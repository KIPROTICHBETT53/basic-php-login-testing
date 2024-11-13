<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Your Orders</h2>
        <?php
        session_start();
        require 'db_connection.php';

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $sql = "SELECT orders.OrderID, products.ProductName, orders.Quantity, orders.OrderDate, orders.Status
                FROM orders
                JOIN products ON orders.ProductID = products.ProductID
                WHERE orders.UserID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='order'>";
                echo "<p><strong>Order ID:</strong> " . htmlspecialchars($row['OrderID']) . "</p>";
                echo "<p><strong>Product:</strong> " . htmlspecialchars($row['ProductName']) . "</p>";
                echo "<p><strong>Quantity:</strong> " . htmlspecialchars($row['Quantity']) . "</p>";
                echo "<p><strong>Date:</strong> " . htmlspecialchars($row['OrderDate']) . "</p>";
                echo "<p><strong>Status:</strong> " . htmlspecialchars($row['Status']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>You have no orders.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
