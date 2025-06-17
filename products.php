<?php include('db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Products</title>
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

/* Navigation Links */
ul {
    list-style-type: none;
    padding: 0;
    text-align: center;
    margin: 15px 0;
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
    color: #ecf0f1;
}

/* Table Styles */
table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
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
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #ddd;
}

a {
    text-decoration: none;
    color: #e74c3c;
    font-weight: bold;
    transition: color 0.3s ease;
}

a:hover {
    color: #c0392b;
}

    </style>
</head>
<body>
    <h2>Products</h2>
    <ul>
    <li><a href="dashboard.php">dashboard</a></li>
        <li><a href="orders.php">Manage Orders</a></li>
        <li><a href="products.php">Manage Products</a></li>
        <li><a href="users.php">Manage Users</a></li>
        <li><a href="logout.php">logout</a></li>
    </ul>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM products");
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>$" . $row['price'] . "</td>
                <td>" . $row['stock'] . "</td>
                <td>
                    <a href='edit_product.php?id=" . $row['id'] . "'>Edit</a> | 
                    <a href='delete_product.php?id=" . $row['id'] . "'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
