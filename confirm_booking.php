<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ganapati_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from POST data
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;

// Get available addresses from the database
$addresses_sql = "SELECT * FROM addresses"; 
$addresses_result = $conn->query($addresses_sql);

// If no addresses are available, inform the user
if ($addresses_result->num_rows == 0) {
    echo "No addresses available. Please add an address before placing an order.";
    exit;
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['address_id']) && isset($_POST['delivery_date'])) {
    // Get the selected address ID and delivery date
    $address_id = $_POST['address_id'];
    $delivery_date = $_POST['delivery_date'];

    // Insert order into the orders table
    $user_id = 1; // Assuming logged in user with ID 1
    $order_number = uniqid('ORD'); // Generate a unique order number
    $total_amount = 500; // Set total amount for the advance payment
    $payment_method = 'Advance Payment'; // Set payment method
    $order_status = 'Pending'; // Set initial order status

    // Insert into orders table
    $sql = "INSERT INTO orders (user_id, order_number, total_amount, payment_method, address_id, order_status, delivery_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssis", $user_id, $order_number, $total_amount, $payment_method, $address_id, $order_status, $delivery_date);
    
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        $confirmation_message = "Your booking has been confirmed! Order Number: " . $order_number . ". Delivery Date: " . $delivery_date;
    } else {
        $confirmation_message = "Error confirming your booking: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="style/styles.css">
    <style>
        /* Reset some default styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Body Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    line-height: 1.6;
}

/* Container Styles */
.container {
    max-width: 600px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Header Styles */
h1 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* Form Styles */
form {
    margin: 20px 0;
}

/* Label Styles */
label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
    color: #555;
}

/* Select Box and Input Styles */
select,
input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

/* Button Styles */
button {
    width: 100%;
    padding: 10px;
    background-color: #28a745; /* Green background */
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

/* Button Hover Effect */
button:hover {
    background-color: #218838; /* Darker green on hover */
}

/* Confirmation Message Styles */
p {
    text-align: center;
    color: #666;
    margin: 15px 0;
}

/* Link Styles */
a {
    display: inline-block;
    margin-top: 20px;
    text-align: center;
    text-decoration: none;
    color: #007bff; /* Blue color */
    transition: color 0.3s;
}

/* Link Hover Effect */
a:hover {
    color: #0056b3; /* Darker blue on hover */
}

/* Responsive Design */
@media (max-width: 600px) {
    .container {
        margin: 20px;
        padding: 15px;
    }
    button {
        font-size: 14px;
    }
    select,
    input[type="date"] {
        font-size: 14px;
    }
}
.qr-code {
    text-align: center;
    margin: 20px 0;
}

.qr-code img {
    max-width: 100%; /* Make the QR code responsive */
    height: auto; /* Maintain aspect ratio */
    margin: 10px 0;
}

    </style>
</head>
<body>
<?php include('header.php'); ?>

<div class="container">
    <h1>Booking Confirmation</h1>

    <?php if (isset($confirmation_message)): ?>
        <p><?php echo $confirmation_message; ?></p>
        
        <div class="qr-code">
            <h2>Pay ₹500 for Advance Payment</h2>
            <!-- Assuming you have a QR code image available at this path -->
            <img src="path/to/your/qrcode.png" alt="QR Code for Payment" />
            <p>Scan the QR code above to complete your payment.</p>
        </div>
    <?php else: ?>
        <form method="POST" action="">
            <label for="address">Select Address:</label>
            <select name="address_id" id="address" required>
                <?php while($address = $addresses_result->fetch_assoc()): ?>
                    <option value="<?php echo $address['id']; ?>">
                        <?php echo $address['address_line1'] . ', ' . $address['city'] . ', ' . $address['state'] . ', ' . $address['postal_code'] . ', ' . $address['country']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="delivery_date">Select Delivery Date:</label>
            <input type="date" name="delivery_date" id="delivery_date" required>

            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <button type="submit">Confirm Booking</button>
        </form>
    <?php endif; ?>

    <p>Your advance payment of ₹500 is refundable upon request.</p>
    <p>Thank you for your order! We will process it shortly.</p>
    <a href="collection.php">Return to Collection</a>
</div>
<?php include('footer.php'); ?>
</body>
</html>
