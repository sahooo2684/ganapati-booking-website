<?php
include('db_connect.php');
$product_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $conn->query("UPDATE products SET name='$name', price='$price', stock='$stock' WHERE id=$product_id");
    header("Location: products.php");
}

$result = $conn->query("SELECT * FROM products WHERE id=$product_id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $row['price']; ?>" required><br>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?php echo $row['stock']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
