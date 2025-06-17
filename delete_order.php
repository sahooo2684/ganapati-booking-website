<?php include('db_connect.php'); ?>

<?php
$order_id = $_GET['id'];
$conn->query("DELETE FROM orders WHERE id=$order_id");
header("Location: dashboard.php");
?>
