<?php
include('db_connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$new_address = $_POST['new_address'];

$insert_query = $conn->prepare("INSERT INTO addresses (user_id, address) VALUES (?, ?)");
$insert_query->bind_param("is", $user_id, $new_address);

if ($insert_query->execute()) {
    echo "Address added successfully!";
} else {
    echo "Error: " . $insert_query->error;
}

$insert_query->close();
$conn->close();
?>
