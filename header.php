<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganapati Booking</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Header Styles */
        .header {
            background-color: #FF6F61;
            padding: 15px 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 90%;
            margin: auto;
        }
        /* Logo */
        .header .logo img {
            height: 60px;
            transition: transform 0.3s ease-in-out;
        }
        .header .logo img:hover {
            transform: scale(1.1);
        }
        /* Navigation */
        .header .nav-menu {
            display: flex;
            list-style: none;
        }
        .header .nav-menu li {
            margin: 0 20px;
            position: relative;
        }
        .header .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .header .nav-menu a:hover {
            color: #FFD700;
        }
        /* Dropdown Menu */
        .header .nav-menu li:hover .dropdown-menu {
            display: block;
        }
        .header .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            top: 40px;
            left: 0;
            min-width: 150px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .header .dropdown-menu a {
            color: black;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .header .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        /* Search Bar */
        .header .search-bar input {
            padding: 8px;
            font-size: 1rem;
            border-radius: 20px;
            border: 1px solid #ddd;
            outline: none;
            transition: width 0.3s ease;
            width: 160px;
        }
        .header .search-bar input:focus {
            width: 250px;
            border-color: #FF6F61;
        }
        /* Call-to-action button */
        .header .cta-btn {
            background-color: #FFD700;
            padding: 8px 15px;
            border-radius: 20px;
            color: #333;
            font-weight: 600;
            text-decoration: none;
            margin-left: 20px;
            transition: background-color 0.3s ease;
        }
        .header .cta-btn:hover {
            background-color: #ffcc00;
        }
        /* User Actions */
        .header .user-actions {
            display: flex;
            align-items: center;
        }
        .header .user-actions a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-size: 1rem;
            position: relative;
            transition: color 0.3s ease;
        }
        .header .user-actions a:hover {
            color: #FFD700;
        }
        .header .user-actions img {
            height: 25px;
            vertical-align: middle;
        }
        /* Cart Badge */
        .header .cart-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: #FFD700;
            border-radius: 50%;
            padding: 3px 8px;
            color: #333;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <a href="home.html"><img src="img/logo.webp" alt="Ganapati Booking"></a><h1>Ganapati Booking</h1>
                
            </div>

            <!-- Navigation Menu -->
            <ul class="nav-menu">
                <li><a href="home.html">Home</a></li>
                <li><a href="collection.php">Collection</a></li>
                <li>
                    <a href="service.php">Services</a>
                    
                </li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>

            <!-- User Actions -->
            <div class="user-actions">
                <a href="login.php">Logout</a>
                <a href="cart.php">
                    <img src="images/cart.jpg" alt="Cart">
                    <span class="cart-badge">0</span>
                </a>
            </div>
        </div>
    </header>
</body>
</html>
