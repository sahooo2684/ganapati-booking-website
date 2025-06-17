<?php
include('db_connect.php');

// Initialize the session
session_start();

// Fetch order ID from query parameter (or session, if preferred)
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;

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
} else {
    // Handle invalid order ID
    echo "Invalid order ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Order Confirmation Page Styles */
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        .confirmation-message {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            border-radius: 10px;
            background-color: #dff0d8;
            color: #3c763d;
        }

        .order-summary {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .order-summary h3 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #333;
        }

        .order-summary p, .order-summary li {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .track-order-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 1.2rem;
            color: #FF6F61;
            text-decoration: none;
        }

        .track-order-link:hover {
            color: #ff4a3a;
        }
    </style>
</head>
<body>
    <!-- Header (Same as Home Page) -->
    <?php include('header.php'); ?>

    <!-- Confirmation Message -->
    <div class="container">
        <div class="confirmation-message">
            <h2>Thank You for Your Order!</h2>
            <p>Your order has been placed successfully.</p>
            <p><strong>Order Number:</strong> <?php echo $order['id']; ?></p>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h3>Order Summary</h3>
            <p><strong>Delivery Address:</strong> <?php echo $order['address'] . ', ' . $order['city'] . ', ' . $order['state'] . ' - ' . $order['zip']; ?></p>
            <p><strong>Total Amount:</strong> ₹<?php echo number_format($order['total_amount'], 2); ?></p>

            <h4>Items Ordered:</h4>
            <ul>
                <?php while ($item = $items_result->fetch_assoc()) { ?>
                    <li><?php echo $item['name']; ?> (Quantity: <?php echo $item['quantity']; ?>) - ₹<?php echo number_format($item['price'], 2); ?></li>
                <?php } ?>
            </ul>
        </div>

        <!-- Order Tracking Link -->
        <a href="track_order.php?order_id=<?php echo $order['id']; ?>" class="track-order-link">Track Your Order</a>
    </div>

    <!-- Footer (Same as Home Page) -->
    <?php include('footer.php'); ?>
</body>
</html>

<?php
$conn->close();
?>
