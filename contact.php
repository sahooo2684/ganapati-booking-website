<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Ganapati Booking</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Contact Us Page Styles */
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        .contact-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .contact-form {
            width: 60%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            font-size: 2rem;
            color: #FF6F61;
            margin-bottom: 20px;
        }

        .contact-form label {
            font-size: 1rem;
            color: #333;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .contact-form button {
            background-color: #FF6F61;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #e65c50;
        }

        .contact-info {
            width: 35%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-info h2 {
            font-size: 2rem;
            color: #FF6F61;
            margin-bottom: 20px;
        }

        .contact-info p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #333;
        }

        .map-container {
            margin-top: 30px;
            width: 100%;
            height: 400px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>
<body>
    <!-- Header (Same as Home Page) -->
    <?php include('header.php'); ?>

    <div class="container">
        <!-- Contact Us Section -->
        <div class="contact-section">
            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Contact Us</h2>
                <form action="send_message.php" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone">
                    
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                    
                    <button type="submit">Send Message</button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p><strong>Address:</strong> 123 Ganapati Street, Mumbai, India</p>
                <p><strong>Phone:</strong> +91 12345 67890</p>
                <p><strong>Email:</strong> support@ganapatibooking.com</p>
            </div>
        </div>

        <!-- Google Maps Integration -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11654.647432972462!2d72.84472751071515!3d19.0760904694701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c84c3f9b1b1d%3A0x87202d1f3bb0b3d1!2sGanapati%20Street%2C%20Mumbai%2C%20India!5e0!3m2!1sen!2sus!4v1644280809730!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <!-- Footer (Same as Home Page) -->
    <?php include('footer.php'); ?>
</body>
</html>
