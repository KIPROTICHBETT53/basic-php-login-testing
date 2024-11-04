<?php
// Start session to store user data
session_start();
require 'db_connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Insert user data into the database
    $sql = "INSERT INTO Users (Username, Email, Password) VALUES (?, ?, ?)"; // Ensure Password is the correct column
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $passwordHash); // Use the same variable names

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="register.php">
        <label>Username: </label><input type="text" name="username" required><br>
        <label>Email: </label><input type="email" name="email" required><br>
        <label>Password: </label><input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
