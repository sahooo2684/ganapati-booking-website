<?php
include('db_connect.php');
$user_id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id=$user_id");
header("Location: users.php");
?>