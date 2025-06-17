<?php
include('db_connect.php');
$user_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $conn->query("UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$user_id");
    header("Location: users.php");
}

$result = $conn->query("SELECT * FROM users WHERE id=$user_id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
