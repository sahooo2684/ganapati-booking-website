<?php
include('db_connect.php');

// Fetch product details based on product ID
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$query = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($query);
$product = $result->fetch_assoc();

// Fetch related products
$related_query = "SELECT * FROM products WHERE id != $product_id LIMIT 4";
$related_result = $conn->query($related_query);

// Fetch customer reviews (dummy data for now)
$reviews = [
    ["name" => "Rohit Sharma", "rating" => 5, "comment" => "Beautiful murti with excellent craftsmanship!"],
    ["name" => "Priya Singh", "rating" => 4, "comment" => "Looks great, but could have been packaged better."]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganapati Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Page Styling */
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        .product-gallery, .product-details {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
        }

        .product-gallery img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-thumbnails img {
            width: 100px;
            cursor: pointer;
            border: 2px solid #ddd;
            border-radius: 8px;
        }

        .product-thumbnails img:hover {
            border-color: #FF6F61;
        }

        .product-details h2 {
            margin-bottom: 10px;
            font-size: 2rem;
            color: #333;
        }

        .product-details p {
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .product-options {
            margin-bottom: 20px;
        }

        .product-options select, .product-options input {
            padding: 8px;
            width: 150px;
            margin-right: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .product-details .btn {
            background-color: #FF6F61;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1rem;
        }

        .product-details .btn:hover {
            background-color: #ff4a3a;
        }

        .related-products h3, .customer-reviews h3 {
            margin-top: 40px;
            margin-bottom: 20px;
            color: #333;
        }

        .related-products .product-item, .customer-reviews .review-item {
            display: inline-block;
            width: 23%;
            margin-right: 1%;
            text-align: center;
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .related-products img {
            width: 100%;
            border-radius: 8px;
            height: 150px;
            object-fit: cover;
        }

        .review-item {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .review-item p {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Header (Same as Home Page) -->
    <?php include('header.php'); ?>

    <!-- Main Content -->
    <div class="container">
        <div class="product-gallery">
            <div class="main-image">
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="product-thumbnails">
                <!-- Add thumbnail images -->
                <img src="images/<?php echo $product['image']; ?>" alt="Thumbnail">
                <img src="images/<?php echo $product['image']; ?>" alt="Thumbnail">
                <img src="images/<?php echo $product['image']; ?>" alt="Thumbnail">
            </div>
        </div>
        <div class="product-details">
            <h2><?php echo $product['name']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <p><strong>Material:</strong> <?php echo $product['material']; ?></p>
            <p><strong>Size:</strong> <?php echo $product['size']; ?></p>
            <p><strong>Price:</strong> ₹<?php echo number_format($product['price'], 2); ?></p>

            <div class="product-options">
                <label for="size">Choose Size:</label>
                <select id="size" name="size">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1">
            </div>

            <button class="btn">Add to Cart</button>
        </div>
    </div>

    <!-- Related Products -->
    <div class="container related-products">
        <h3>Related Products</h3>
        <?php while($related = $related_result->fetch_assoc()): ?>
            <div class="product-item">
                <img src="images/<?php echo $related['image']; ?>" alt="<?php echo $related['name']; ?>">
                <h4><?php echo $related['name']; ?></h4>
                <p>₹<?php echo number_format($related['price'], 2); ?></p>
                <a href="product_details.php?id=<?php echo $related['id']; ?>" class="btn">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Customer Reviews -->
    <div class="container customer-reviews">
        <h3>Customer Reviews</h3>
        <?php foreach($reviews as $review): ?>
            <div class="review-item">
                <h4><?php echo $review['name']; ?></h4>
                <p>Rating: <?php echo str_repeat('⭐', $review['rating']); ?></p>
                <p><?php echo $review['comment']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer (Same as Home Page) -->
    <?php include('footer.php'); ?>
</body>
</html>

<?php
$conn->close();
?>
