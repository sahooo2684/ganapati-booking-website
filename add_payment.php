<?php
include('db_connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$new_payment_method = $_POST['new_payment_method'];

$insert_query = $conn->prepare("INSERT INTO payment_methods (user_id, method) VALUES (?, ?)");
$insert_query->bind_param("is", $user_id, $new_payment_method);

if ($insert_query->execute()) {
    echo "Payment method added successfully!";
} else {
    echo "Error: " . $insert_query->error;
}

$insert_query->close();
$conn->close();
?>
