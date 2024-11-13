<?php
// db_connection.php
$servername = "localhost";
$username = "Bett";
$password = "kiprotich8653";
$dbname = "ecommerce_db1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
