<?php
// Include database connection
include('db_connection.php');

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$user_query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();

// Fetch order history
$orders_query = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
$orders_query->bind_param("i", $user_id);
$orders_query->execute();
$orders_result = $orders_query->get_result();

// Fetch saved addresses
$addresses_query = $conn->prepare("SELECT * FROM addresses WHERE user_id = ?");
$addresses_query->bind_param("i", $user_id);
$addresses_query->execute();
$addresses_result = $addresses_query->get_result();

// Fetch saved payment methods
$payment_methods_query = $conn->prepare("SELECT * FROM payment_methods WHERE user_id = ?");
$payment_methods_query->bind_param("i", $user_id);
$payment_methods_query->execute();
$payment_methods_result = $payment_methods_query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Ganapati Booking</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Profile Page Styles */
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        .profile-info, .order-history, .saved-addresses, .saved-payment-methods {
            margin-bottom: 30px;
        }

        .profile-info h2, .order-history h2, .saved-addresses h2, .saved-payment-methods h2 {
            font-size: 2rem;
            color: #FF6F61;
            margin-bottom: 20px;
        }

        .profile-info form, .saved-addresses form, .saved-payment-methods form {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-info label, .saved-addresses label, .saved-payment-methods label {
            display: block;
            margin-bottom: 10px;
            font-size: 1rem;
            color: #333;
        }

        .profile-info input, .saved-addresses input, .saved-addresses textarea, .saved-payment-methods input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .profile-info button, .saved-addresses button, .saved-payment-methods button {
            background-color: #FF6F61;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .profile-info button:hover, .saved-addresses button:hover, .saved-payment-methods button:hover {
            background-color: #e65c50;
        }

        .order-history table, .saved-addresses table, .saved-payment-methods table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-history th, .saved-addresses th, .saved-payment-methods th {
            background-color: #FF6F61;
            color: white;
            padding: 10px;
        }

        .order-history td, .saved-addresses td, .saved-payment-methods td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <!-- Header (Same as Home Page) -->
    <?php include('header.php'); ?>

    <div class="container">
        <!-- Profile Information -->
        <div class="profile-info">
            <h2>Profile Information</h2>
            <form action="update_profile.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3"><?php echo htmlspecialchars($user['address']); ?></textarea>
                
                <button type="submit">Update Profile</button>
            </form>
        </div>

        <!-- Order History -->
        <div class="order-history">
            <h2>Order History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $orders_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                            <td><a href="order_details.php?id=<?php echo htmlspecialchars($order['id']); ?>">View Details</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Saved Addresses -->
        <div class="saved-addresses">
            <h2>Saved Addresses</h2>
            <table>
                <thead>
                    <tr>
                        <th>Address ID</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($address = $addresses_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($address['id']); ?></td>
                            <td><?php echo htmlspecialchars($address['address']); ?></td>
                            <td>
                                <a href="edit_address.php?id=<?php echo htmlspecialchars($address['id']); ?>">Edit</a> | 
                                <a href="delete_address.php?id=<?php echo htmlspecialchars($address['id']); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <form action="add_address.php" method="POST">
                <h3>Add New Address</h3>
                <label for="new_address">Address:</label>
                <input type="text" id="new_address" name="new_address" required>
                
                <button type="submit">Add Address</button>
            </form>
        </div>

        <!-- Saved Payment Methods -->
        <div class="saved-payment-methods">
            <h2>Saved Payment Methods</h2>
            <table>
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Payment Method</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($payment_method = $payment_methods_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($payment_method['id']); ?></td>
                            <td><?php echo htmlspecialchars($payment_method['method']); ?></td>
                            <td>
                                <a href="edit_payment.php?id=<?php echo htmlspecialchars($payment_method['id']); ?>">Edit</a> | 
                                <a href="delete_payment.php?id=<?php echo htmlspecialchars($payment_method['id']); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <form action="add_payment.php" method="POST">
                <h3>Add New Payment Method</h3>
                <label for="new_payment_method">Payment Method:</label>
                <input type="text" id="new_payment_method" name="new_payment_method" required>
                
                <button type="submit">Add Payment Method</button>
            </form>
        </div>
    </div>

    <!-- Footer (Same as Home Page) -->
    <?php include('footer.php'); ?>
</body>
</html>
