<?php
// db_connection.php
$host = 'localhost';     // Database host (usually localhost)
$dbname = 'ganapati_booking';  // Your database name
$username = 'root';      // Your database username
$password = '';          // Your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

