<?php
include('db_connect.php');

// Initialize the session
session_start();

$order_id = '';
$order = null;
$items = null;
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = trim($_POST['order_id']);

    // Validate input
    if (!empty($order_id)) {
        // Fetch order details from the database
        $order_query = "SELECT * FROM orders WHERE id = '$order_id'";
        $order_result = $conn->query($order_query);

        if ($order_result->num_rows > 0) {
            $order = $order_result->fetch_assoc();
            
            // Fetch order items
            $items_query = "SELECT oi.quantity, oi.price, p.name 
                            FROM order_items oi 
                            JOIN products p ON oi.product_id = p.id 
                            WHERE oi.order_id = '$order_id'";
            $items_result = $conn->query($items_query);
            $items = $items_result->fetch_all(MYSQLI_ASSOC);
        } else {
            $error = "Order not found. Please check your Order ID.";
        }
    } else {
        $error = "Please enter a valid Order ID.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Order</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Track Order Page Styles */
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        .track-order-form {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .track-order-form input[type="text"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .track-order-form input[type="submit"] {
            padding: 10px 20px;
            font-size: 1.2rem;
            background-color: #FF6F61;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .track-order-form input[type="submit"]:hover {
            background-color: #ff4a3a;
        }

        .order-summary {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .order-summary h3, .order-summary h4 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #333;
        }

        .order-summary p, .order-summary li {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .error {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Header (Same as Home Page) -->
    <?php include('header.php'); ?>

    <div class="container">
        <!-- Track Order Form -->
        <div class="track-order-form">
            <h2>Track Your Order</h2>
            <form action="track_order.php" method="POST">
                <input type="text" name="order_id" placeholder="Enter your Order ID" value="<?php echo htmlspecialchars($order_id); ?>" required>
                <input type="submit" value="Track Order">
            </form>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>

        <?php if ($order): ?>
        <!-- Order Summary -->
        <div class="order-summary">
            <h3>Order Summary</h3>
            <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
            <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
            <p><strong>Delivery Address:</strong> <?php echo $order['address'] . ', ' . $order['city'] . ', ' . $order['state'] . ' - ' . $order['zip']; ?></p>
            <p><strong>Total Amount:</strong> ₹<?php echo number_format($order['total_amount'], 2); ?></p>

            <h4>Items Ordered:</h4>
            <ul>
                <?php foreach ($items as $item): ?>
                    <li><?php echo $item['name']; ?> (Quantity: <?php echo $item['quantity']; ?>) - ₹<?php echo number_format($item['price'], 2); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>

    <!-- Footer (Same as Home Page) -->
    <?php include('footer.php'); ?>
</body>
</html>
