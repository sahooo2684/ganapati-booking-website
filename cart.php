<?php
include('db_connection.php');

// Initialize the session
session_start();

// Fetch cart items from the session or database (assuming session-based cart)
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Calculate subtotal, tax, and total
$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$tax = $subtotal * 0.05; // Assuming 5% tax
$total = $subtotal + $tax;

// Handle quantity update or item removal
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    } elseif (isset($_POST['remove'])) {
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);
    }
    header('Location: cart.php'); // Refresh the page to reflect changes
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Cart Page Styles */
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        .cart-items {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .cart-items th, .cart-items td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-items img {
            width: 80px;
            height: auto;
            border-radius: 8px;
        }

        .cart-items td input[type="number"] {
            width: 50px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .cart-items td form {
            display: inline-block;
        }

        .cart-items .remove-btn {
            background-color: #FF6F61;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .cart-items .remove-btn:hover {
            background-color: #ff4a3a;
        }

        .order-summary {
            width: 100%;
            max-width: 400px;
            margin: auto;
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

        .order-summary p {
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
        }

        .order-summary .checkout-btn {
            width: 100%;
            padding: 10px 0;
            background-color: #FF6F61;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .order-summary .checkout-btn:hover {
            background-color: #ff4a3a;
        }
    </style>
</head>
<body>
    <!-- Header (Same as Home Page) -->
    <?php include('header.php'); ?>

    <!-- Cart Items List -->
    <div class="container">
        <h2>Your Cart</h2>
        <table class="cart-items">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cart_items)): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td>
                                <img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                <?php echo $item['name']; ?>
                            </td>
                            <td>₹<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <button type="submit" name="update" class="remove-btn">Update</button>
                                </form>
                            </td>
                            <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="remove" class="remove-btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Order Summary -->
        <div class="order-summary">
            <h3>Order Summary</h3>
            <p><span>Subtotal:</span> <span>₹<?php echo number_format($subtotal, 2); ?></span></p>
            <p><span>Tax (5%):</span> <span>₹<?php echo number_format($tax, 2); ?></span></p>
            <p><strong><span>Total:</span> <span>₹<?php echo number_format($total, 2); ?></span></strong></p>
            <button class="checkout-btn" onclick="window.location.href='checkout.php';">Proceed to Checkout</button>
        </div>
    </div>

    <!-- Footer (Same as Home Page) -->
    <?php include('footer.php'); ?>
</body>
</html>

