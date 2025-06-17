<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple authentication (use hashed passwords in real scenarios)
    if ($username === 'admin' && $password === '123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <style>
        /* General Page Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7f6;
    margin: 0;
    padding: 0;
    color: #333;
}

h2 {
    text-align: center;
    color: #2c3e50;
    margin-top: 20px;
    font-weight: bold;
}

/* Form Styles */
form {
    width: 300px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    color: #2c3e50;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}

/* Error Message Styles */
p.error {
    color: #e74c3c;
    text-align: center;
    font-weight: bold;
}

    </style>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
