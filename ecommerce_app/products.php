<?php
session_start();
require 'db_connection.php';  // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>
    <h2>Product List</h2>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! Here are the available products:</p>

    <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Description</th>
        </tr>

        <?php
        // Fetch products from the database
        $sql = "SELECT ProductName, Price, Quantity, Description FROM Products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['ProductName']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Stock']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Description']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No products found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
