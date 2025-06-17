<?php include('db_connect.php'); ?>
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <style>
        /* General Style */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7f6;
    margin: 0;
    padding: 0;
    color: #333;
}

h2, h3 {
    text-align: center;
    color: #2c3e50;
    margin-top: 20px;
    font-weight: 700;
}

a {
    text-decoration: none;
    color: #3498db;
}

ul {
    list-style: none;
    padding: 0;
    text-align: center;
    margin-top: 10px;
}

ul li {
    display: inline-block;
    margin: 0 10px;
}

ul li a {
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

ul li a:hover {
    background-color: #2980b9;
}

/* Table Styles */
table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

th, td {
    padding: 15px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #2c3e50;
    color: white;
    font-weight: bold;
    text-align: center;
}

td {
    background-color: #ecf0f1;
    color: #2c3e50;
    text-align: center;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

a.action-link {
    color: #e74c3c;
    font-weight: bold;
    transition: color 0.3s ease;
}

a.action-link:hover {
    color: #c0392b;
}

/* Sales Info */
h3 {
    margin-bottom: 5px;
}

p {
    text-align: center;
    font-size: 1.2em;
    color: #27ae60;
    font-weight: bold;
    background-color: #ecf0f1;
    padding: 10px;
    border-radius: 8px;
    width: 50%;
    margin: 0 auto 20px auto;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
}

    </style>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <ul>
        <li><a href="orders.php">Manage Orders</a></li>
        <li><a href="products.php">Manage Products</a></li>
        <li><a href="users.php">Manage Users</a></li>
        <li><a href="logout.php">logout</a></li>
    </ul>
</body>
</html>

    <!-- Total Sales -->
    <h3>Total Sales</h3>
    <?php
    $result = $conn->query("SELECT SUM(total_amount) AS total_sales FROM orders");
    $row = $result->fetch_assoc();
    echo "<p>Total Sales: $" . $row['total_sales'] . "</p>";
    ?>

    <!-- Orders Table -->
    <h3>Orders</h3>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Order Number</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM orders");
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['order_number']}</td>
                <td>\${$row['total_amount']}</td>
                <td>{$row['order_status']}</td>
                <td>
                    <a href='edit_order.php?id={$row['id']}'>Edit</a> | 
                    <a href='delete_order.php?id={$row['id']}'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>

    <!-- Add similar tables for Users, Products, Cart, etc. -->

</body>
</html>
