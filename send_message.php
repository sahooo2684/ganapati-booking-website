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

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $message);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>
        // Display popup message
        alert('Message sent successfully!');
        
        // Wait 3 seconds, then redirect to contact page
        setTimeout(function(){
            window.location.href = 'contact.php';
        }, 3000);
    </script>";
} else {
    echo "<script>
        alert('Error: " . $stmt->error . "');
    </script>";
}

// Close connections
$stmt->close();
$conn->close();
?>
