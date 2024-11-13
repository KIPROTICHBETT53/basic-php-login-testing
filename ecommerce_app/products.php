<?php
// Start the session to check if the user is logged in
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Include the database connection
require 'db_connection.php';

// Retrieve products from the database
$sql = "SELECT ProductID, ProductName, Price, Stock, Description FROM products";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Product List</h2>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Description</th>
        </tr>
        <?php
        // Check if there are products to display
        if ($result->num_rows > 0) {
            // Output each product row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['ProductID']}</td>
                        <td>{$row['ProductName']}</td>
                        <td>{$row['Price']}</td>
                        <td>{$row['Stock']}</td>
                        <td>{$row['Description']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No products found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
