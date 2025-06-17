<?php
// Start the session to manage the cart
session_start();

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

// Get material filter from the user if applied
$filter = isset($_GET['material']) ? $_GET['material'] : '';

// Fetch products from the database based on the material filter
$sql = "SELECT * FROM products";
if ($filter) {
    $sql .= " WHERE material = ?";
}

$stmt = $conn->prepare($sql);
if ($filter) {
    $stmt->bind_param("s", $filter);
}
$stmt->execute();
$result = $stmt->get_result();

// Fetch distinct materials for filter dropdown
$material_sql = "SELECT DISTINCT material FROM products";
$material_result = $conn->query($material_sql);

// Check if a product is being added to the cart
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database based on the product ID
    $product_query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($product_query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product_result = $stmt->get_result();

    if ($product_result->num_rows > 0) {
        $product = $product_result->fetch_assoc();
        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$product_id])) {
            // Increase the quantity
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            // Add product to cart
            $_SESSION['cart'][$product_id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $product['image_url'] // Ensure you use the correct field
            ];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganapati Collection</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        
        /* Basic styles for the collection page */
        .collection-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }
        .filter-section {
            margin-bottom: 20px;
            text-align: center;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .product-item {
            margin: 15px;
            padding: 20px;
            border: 1px solid #ddd;
            text-align: center;
            width: 300px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .product-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-item h3 {
            margin: 15px 0;
            font-size: 1.2rem;
        }
        .product-item p {
            margin: 10px 0;
            color: #333;
        }
        .product-item .material-size {
            margin: 10px 0;
            font-size: 0.9rem;
            color: #555;
        }
        .product-item button {
            padding: 10px 20px;
            background-color: #FF6F61;
            color: white;
            border: none;
            cursor: pointer;
        }
        .product-item button:hover {
            background-color: #e55c50;
        }
    </style>
</head>
<body>
<?php include('header.php'); ?>

<div class="collection-container">
    <h1>Ganapati Collection</h1>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="collection.php">
            <label for="material">Filter by Material: </label>
            <select name="material" id="material" onchange="this.form.submit()">
                <option value="">All</option>
                <?php while($material = $material_result->fetch_assoc()): ?>
                    <option value="<?php echo $material['material']; ?>" <?php if($filter == $material['material']) echo 'selected'; ?>>
                        <?php echo ucfirst($material['material']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>

    <!-- Product Grid -->
    <div class="product-grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="product-item">
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <p class="material-size">Material: <?php echo $row['material']; ?> | Size: <?php echo $row['size']; ?></p>
                    <p>Price: ₹<?php echo $row['price']; ?></p>
                    <p>Stock: <?php echo $row['stock'] > 0 ? $row['stock'] . ' available' : 'Out of Stock'; ?></p>
                    <a href="collection.php?product_id=<?php echo $row['id']; ?>">
                        <button <?php if($row['stock'] <= 0) echo 'disabled'; ?>>Book Now</button>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</div>
<?php include('footer.php'); ?>


<?php
// Close database connection
$stmt->close();
$conn->close();
?>

</body>
</html>
