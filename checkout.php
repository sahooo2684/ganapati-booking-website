<?php
include('db_connection.php');

// Initialize the session
session_start();

// Fetch cart items from the session
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$subtotal = 0;

foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$tax = $subtotal * 0.05; // Assuming 5% tax
$total = $subtotal + $tax + 50; // Assuming a flat delivery charge of ₹50

// Handle order placement
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $payment_method = $_POST['payment_method'];

    // Insert order into the database
    $order_query = "INSERT INTO orders (customer_name, email, phone, address, city, state, zip, payment_method, total_amount) VALUES ('$name', '$email', '$phone', '$address', '$city', '$state', '$zip', '$payment_method', '$total')";
    if ($conn->query($order_query) === TRUE) {
        $order_id = $conn->insert_id;

        // Insert order items into the database
        foreach ($cart_items as $item) {
            $product_id = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')");
        }

        // Clear the cart
        unset($_SESSION['cart']);

        // Redirect to a thank you page
        header('Location: order_conformation.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        /* Checkout Form Styles */

.container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 30px auto;
    width: 90%;
    max-width: 600px;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

h3 {
    margin-top: 20px;
    color: #555;
    font-size: 1.2rem;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="tel"],
select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
select:focus {
    border-color: #FF6F61; /* Highlight border on focus */
    outline: none; /* Remove outline */
}

.order-summary {
    margin-top: 20px;
    padding: 15px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.order-summary p {
    margin: 10px 0;
    display: flex;
    justify-content: space-between;
}

.place-order-btn {
    width: 100%;
    padding: 12px;
    background-color: #FF6F61;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.place-order-btn:hover {
    background-color: #e55c50; /* Darker shade on hover */
}

/* Responsive Styles */
@media (max-width: 600px) {
    .container {
        width: 95%; /* Slightly wider on small screens */
    }

    h2 {
        font-size: 1.5rem; /* Adjust font size for smaller screens */
    }

    .place-order-btn {
        font-size: 1rem; /* Adjust button font size */
    }
}

    </style>
</head>
<body>
    <!-- Header (Same as Home Page) -->
    <?php include('header.php'); ?>

    <!-- Checkout Form -->
    <div class="container">
        <h2>Checkout</h2>
        <form method="POST" action="checkout.php">
            <!-- Shipping Information -->
            <h3>Shipping Information</h3>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div class="form-group">
                <label for="zip">ZIP Code</label>
                <input type="text" id="zip" name="zip" required>
            </div>

            <!-- Payment Information -->
            <h3>Payment Information</h3>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="Credit/Debit Card">Credit/Debit Card</option>
                    <option value="UPI">UPI</option>
                    <option value="Net Banking">Net Banking</option>
                    <option value="COD">Cash on Delivery (COD)</option>
                </select>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3>Order Summary</h3>
                <p><span>Subtotal:</span> <span>₹<?php echo number_format($subtotal, 2); ?></span></p>
                <p><span>Tax (5%):</span> <span>₹<?php echo number_format($tax, 2); ?></span></p>
                <p><span>Delivery Charges:</span> <span>₹50.00</span></p>
                <p><strong><span>Total:</span> <span>₹<?php echo number_format($total, 2); ?></span></strong></p>
                <button type="submit" class="place-order-btn">Place Order</button>
            </div>
        </form>
    </div>

    <!-- Footer (Same as Home Page) -->
    <?php include('footer.php'); ?>
</body>
</html>