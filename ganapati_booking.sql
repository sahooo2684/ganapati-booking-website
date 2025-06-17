-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 09:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ganapati_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`, `created_at`) VALUES
(1, 1, '123 Ganapati Lane', 'Near Ganapati Temple', 'Mumbai', 'Maharashtra', '400001', 'India', '2024-10-04 19:17:27'),
(2, 1, '456 Shree Ganesh Marg', '', 'Pune', 'Maharashtra', '411001', 'India', '2024-10-04 19:17:27'),
(3, 2, '789 Kalyan Street', 'Flat No. 5', 'Kalyan', 'Maharashtra', '421301', 'India', '2024-10-04 19:17:27'),
(4, 3, '101 Ganapati Complex', 'Building A, 2nd Floor', 'Navi Mumbai', 'Maharashtra', '400707', 'India', '2024-10-04 19:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `phone`) VALUES
(1, 'abc', 'sahil@gmail.com', '', 'abc', '2024-10-04 17:56:24', '1234567890'),
(2, 'abc', 'sahil@gmail.com', '', 'abc', '2024-10-04 17:57:45', '1234567890'),
(3, 'abc', 'sahil@gmail.com', '', 'abc', '2024-10-04 18:01:44', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `address_id` int(11) NOT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_date` date DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total_amount`, `payment_method`, `address_id`, `order_status`, `created_at`, `delivery_date`, `customer_name`, `email`, `phone`, `address`, `city`, `state`, `zip`) VALUES
(6, 1, 'ORD6700428ce2631', 500.00, 'Advance Payment', 1, '0', '2024-10-04 19:31:24', '2024-10-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_holder_name` varchar(100) NOT NULL,
  `expiration_date` varchar(7) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `material` varchar(100) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `material`, `size`, `price`, `stock`, `image_url`, `created_at`) VALUES
(1, 'Ganapati Murti 1', 'Beautiful handmade Ganapati Murti', 'Clay', 'Medium', 1500.00, 20, 'img/img1.jpg', '2024-09-30 14:10:59'),
(2, 'Ganapati Murti 2', 'Eco-friendly Ganapati idol', 'Clay', 'Large', 2000.00, 15, 'img/img2.jpg', '2024-09-30 14:10:59'),
(3, 'Ganapati Murti 3', 'Gold-painted Ganapati idol', 'Plaster', 'Small', 1000.00, 30, 'img/img3.jpg', '2024-09-30 14:10:59'),
(4, 'Ganapati Murti 4', 'Fiber Ganapati murti, lightweight and durable for long-lasting use.', 'Fiber', 'small', 1800.00, 8, 'img/img4.avif', '2024-10-04 11:42:52'),
(5, 'Ganapati Murti 5', 'Elegant clay murti of Lord Ganesha, ideal for festive decorations.', 'Clay', 'medium', 3000.00, 6, 'img/img5.jpg', '2024-10-04 11:42:52'),
(6, 'Ganapati Murti 6', 'Aesthetic plaster Ganesha murti with a golden finish and vibrant colors.', 'Plaster', 'large', 5000.00, 2, 'img/img6.webp', '2024-10-04 11:42:52'),
(7, 'Ganapati Murti 7', 'Fiber Ganesha idol, highly durable and lightweight, perfect for outdoors.', 'Fiber', 'medium', 3200.00, 7, 'img/img7.WEBP', '2024-10-04 11:42:52'),
(8, 'Ganapati Murti 8', 'Clay Ganesha idol with intricate hand-painted details and fine craftsmanship.', 'Clay', 'large', 4000.00, 4, 'img/img8.jpg', '2024-10-04 11:42:52'),
(9, 'Ganapati Murti 9', 'Plaster murti of Lord Ganesha, detailed craftsmanship with gold accents.', 'Plaster', 'small', 1200.00, 12, 'img/img9.jpg', '2024-10-04 11:42:52'),
(10, 'Ganapati Murti 10', 'Stylish fiber Ganesha murti, designed for modern home decor.', 'Fiber', 'small', 1700.00, 9, 'img/img10.WEBP', '2024-10-04 11:42:52'),
(11, 'Ganapati Murti 11', 'Classic clay murti of Lord Ganesha, a traditional choice for Ganesh Chaturthi.', 'Clay', 'medium', 2800.00, 5, 'img/img11.jpg', '2024-10-04 11:42:52'),
(12, 'Ganapati Murti 12', 'A grand plaster statue of Lord Ganesha, perfect for temples and large spaces.', 'Plaster', 'large', 7000.00, 1, 'img/img12.webp', '2024-10-04 11:42:52'),
(13, 'Ganapati Murti 13', 'Fiber Ganesha idol with a sleek and modern look for contemporary spaces.', 'Fiber', 'medium', 3500.00, 6, 'img/img13.webp', '2024-10-04 11:42:52'),
(14, 'Ganapati Murti 14', 'Hand-crafted clay Ganesha murti with ornate jewelry and bright colors.', 'Clay', 'small', 1300.00, 11, 'img/img14.webp', '2024-10-04 11:42:52'),
(15, 'Ganapati Murti 15', 'Detailed plaster statue of Lord Ganesha with a serene expression.', 'Plaster', 'medium', 2600.00, 4, 'img/img15.avif', '2024-10-04 11:42:52'),
(16, 'Ganapati Murti 16', 'Durable fiber Ganesha idol, weatherproof and ideal for outdoor shrines.', 'Fiber', 'large', 5000.00, 2, 'img/img16.webp', '2024-10-04 11:42:52'),
(17, 'Ganapati Murti 17', 'Classic clay murti of Ganesha with traditional designs and vivid colors.', 'Clay', 'small', 1100.00, 10, 'img/img17.jpeg', '2024-10-04 11:42:52'),
(18, 'Ganapati Murti 18', 'A beautiful large plaster Ganesha murti with intricate detailing and a gold crown.', 'Plaster', 'large', 6000.00, 1, 'img/img18.jpeg', '2024-10-04 11:42:52'),
(19, 'Ganapati Murti 19', 'Stylized fiber Ganesha murti, perfect for modern decor.', 'Fiber', 'medium', 3300.00, 6, 'img/img19.jpg', '2024-10-04 11:42:52'),
(20, 'Ganapati Murti 20', 'Traditional clay Ganesha murti, vibrant and full of character.', 'Clay', 'medium', 2400.00, 8, 'img/img20.jpg', '2024-10-04 11:42:52'),
(21, 'Ganapati Murti 21', 'Elegant large fiber Ganesha statue, perfect for big halls or pooja rooms.', 'Fiber', 'large', 5500.00, 3, 'img/img21.jpeg', '2024-10-04 11:42:52'),
(22, 'Ganapati Murti 22', 'Hand-painted clay murti of Lord Ganesha with golden ornaments.', 'Clay', 'small', 1400.00, 9, 'img/img22.jpg', '2024-10-04 11:42:52'),
(23, 'Ganapati Murti 23', 'A medium-sized plaster Ganesha idol, crafted with attention to detail.', 'Plaster', 'medium', 3100.00, 5, 'img/img23.jpg', '2024-10-04 11:42:52'),
(24, 'Ganapati Murti 24', 'Fiber Ganesha idol with an intricate design and weather-resistant material.', 'Fiber', 'large', 4700.00, 2, 'img/img24.jpeg', '2024-10-04 11:42:52'),
(25, 'Ganapati Murti 1', 'Beautiful clay murti of Lord Ganesha in vibrant colors.', 'Clay', 'small', 1500.00, 10, 'img/img1.jpg', '2024-10-04 11:45:40'),
(26, 'Ganapati Murti 2', 'Traditional Ganesha murti made of clay, perfect for home puja.', 'Clay', 'medium', 2500.00, 5, 'img/img2.jpg', '2024-10-04 11:45:40'),
(27, 'Ganapati Murti 3', 'Plaster Ganesha statue with intricate details and colorful attire.', 'Plaster', 'large', 4500.00, 3, 'img/img3.jpg', '2024-10-04 11:45:40'),
(28, 'Ganapati Murti 4', 'Fiber Ganapati murti, lightweight and durable for long-lasting use.', 'Fiber', 'small', 1800.00, 8, 'img/img4.avif', '2024-10-04 11:45:40'),
(29, 'Ganapati Murti 5', 'Elegant clay murti of Lord Ganesha, ideal for festive decorations.', 'Clay', 'medium', 3000.00, 6, 'img/img5.jpg', '2024-10-04 11:45:40'),
(30, 'Ganapati Murti 6', 'Aesthetic plaster Ganesha murti with a golden finish and vibrant colors.', 'Plaster', 'large', 5000.00, 2, 'img/img6.webp', '2024-10-04 11:45:40'),
(31, 'Ganapati Murti 7', 'Fiber Ganesha idol, highly durable and lightweight, perfect for outdoors.', 'Fiber', 'medium', 3200.00, 7, 'img/img7.webp', '2024-10-04 11:45:40'),
(32, 'Ganapati Murti 8', 'Clay Ganesha idol with intricate hand-painted details and fine craftsmanship.', 'Clay', 'large', 4000.00, 4, 'img/img8.jpg', '2024-10-04 11:45:40'),
(33, 'Ganapati Murti 9', 'Plaster murti of Lord Ganesha, detailed craftsmanship with gold accents.', 'Plaster', 'small', 1200.00, 12, 'img/img9.jpg', '2024-10-04 11:45:40'),
(34, 'Ganapati Murti 10', 'Stylish fiber Ganesha murti, designed for modern home decor.', 'Fiber', 'small', 1700.00, 9, 'img/img10.webp', '2024-10-04 11:45:40'),
(35, 'Ganapati Murti 11', 'Classic clay murti of Lord Ganesha, a traditional choice for Ganesh Chaturthi.', 'Clay', 'medium', 2800.00, 5, 'img/img11.jpg', '2024-10-04 11:45:40'),
(36, 'Ganapati Murti 12', 'A grand plaster statue of Lord Ganesha, perfect for temples and large spaces.', 'Plaster', 'large', 7000.00, 1, 'img/img12.webp', '2024-10-04 11:45:40'),
(37, 'Ganapati Murti 13', 'Fiber Ganesha idol with a sleek and modern look for contemporary spaces.', 'Fiber', 'medium', 3500.00, 6, 'img/img13.webp', '2024-10-04 11:45:40'),
(38, 'Ganapati Murti 14', 'Hand-crafted clay Ganesha murti with ornate jewelry and bright colors.', 'Clay', 'small', 1300.00, 11, 'img/img14.webp', '2024-10-04 11:45:40'),
(39, 'Ganapati Murti 15', 'Detailed plaster statue of Lord Ganesha with a serene expression.', 'Plaster', 'medium', 2600.00, 4, 'img/img15.avif', '2024-10-04 11:45:40'),
(40, 'Ganapati Murti 16', 'Durable fiber Ganesha idol, weatherproof and ideal for outdoor shrines.', 'Fiber', 'large', 5000.00, 2, 'img/img16.webp', '2024-10-04 11:45:40'),
(41, 'Ganapati Murti 17', 'Classic clay murti of Ganesha with traditional designs and vivid colors.', 'Clay', 'small', 1100.00, 10, 'img/img17.jpeg', '2024-10-04 11:45:40'),
(42, 'Ganapati Murti 18', 'A beautiful large plaster Ganesha murti with intricate detailing and a gold crown.', 'Plaster', 'large', 6000.00, 1, 'img/img18.jpeg', '2024-10-04 11:45:40'),
(43, 'Ganapati Murti 19', 'Stylized fiber Ganesha murti, perfect for modern decor.', 'Fiber', 'medium', 3300.00, 6, 'img/img19.jpg', '2024-10-04 11:45:40'),
(44, 'Ganapati Murti 20', 'Traditional clay Ganesha murti, vibrant and full of character.', 'Clay', 'medium', 2400.00, 8, 'img/img20.jpg', '2024-10-04 11:45:40'),
(45, 'Ganapati Murti 21', 'Elegant large fiber Ganesha statue, perfect for big halls or pooja rooms.', 'Fiber', 'large', 5500.00, 3, 'img/img21.jpeg', '2024-10-04 11:45:40'),
(46, 'Ganapati Murti 22', 'Hand-painted clay murti of Lord Ganesha with golden ornaments.', 'Clay', 'small', 1400.00, 9, 'img/img22.jpg', '2024-10-04 11:45:40'),
(47, 'Ganapati Murti 23', 'A medium-sized plaster Ganesha idol, crafted with attention to detail.', 'Plaster', 'medium', 3100.00, 5, 'img/img23.jpg', '2024-10-04 11:45:40'),
(48, 'Ganapati Murti 24', 'Fiber Ganesha idol with an intricate design and weather-resistant material.', 'Fiber', 'large', 4700.00, 2, 'img/img24.jpeg', '2024-10-04 11:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `created_at`) VALUES
(1, 'John Doe', 'john@example.com', '1234567890', '123 Main St', 'passwordhash1', '2024-09-30 14:10:45'),
(2, 'Jane Smith', 'jane@example.com', '9876543210', '456 Oak St', 'passwordhash2', '2024-09-30 14:10:45'),
(3, 'Sahil', 'sahil@gmail.com', '1234567890', 'abc', '$2y$10$KSg92q9BDUthUlgcPnbf/.795p8qxtQ57IIXMutu6F6T2cMPuf9Na', '2024-10-04 11:02:29'),
(4, 'prathamesh ', 'prathamesh@gmail.com', '1234567890', 'abc', '$2y$10$FC7OKpgSvy2EeyU4CTEGZOya4ztZoUp0Iy2VptceXzgPmoBRxltg.', '2024-10-04 17:08:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
