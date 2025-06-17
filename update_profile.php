<?php
include('db_connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$update_query = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
$update_query->bind_param("ssssi", $name, $email, $phone, $address, $user_id);

if ($update_query->execute()) {
    echo "Profile updated successfully!";
} else {
    echo "Error: " . $update_query->error;
}

$update_query->close();
$conn->close();
?>
