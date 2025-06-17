<?php
include('db_connect.php');
$order_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_status = $_POST['order_status'];
    $conn->query("UPDATE orders SET order_status='$order_status' WHERE id=$order_id");
    header("Location: orders.php");
}

$result = $conn->query("SELECT * FROM orders WHERE id=$order_id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Order</title>
</head>
<body>
    <h2>Edit Order</h2>
    <form method="post">
        <label for="order_status">Order Status:</label>
        <input type="text" name="order_status" value="<?php echo $row['order_status']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
