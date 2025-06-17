<?php
// Include database connection
include('db_connection.php');

// Start session
session_start();

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into database
            $insert_stmt = $conn->prepare("INSERT INTO users (name, email, phone, address, password) VALUES (:name, :email, :phone, :address, :password)");
            $insert_stmt->bindParam(':name', $name);
            $insert_stmt->bindParam(':email', $email);
            $insert_stmt->bindParam(':phone', $phone);
            $insert_stmt->bindParam(':address', $address);
            $insert_stmt->bindParam(':password', $hashed_password);

            if ($insert_stmt->execute()) {
                $_SESSION['user_id'] = $conn->lastInsertId(); // Set session variable
                header("Location: index.php"); // Redirect to homepage
                exit();
            } else {
                $error_message = "Error: " . $insert_stmt->errorInfo()[2];
            }
        } else {
            $error_message = "Email address is already registered.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ganapati Booking</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .register-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        .register-container h2 {
            color: #FF6F61;
            margin-bottom: 20px;
        }
        .register-container label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        .register-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .register-container button {
            background-color: #FF6F61;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }
        .register-container button:hover {
            background-color: #e65c50;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($error_message)) { ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php } ?>
        <form action="register.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
