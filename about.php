<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Ganapati Booking</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* About Us Page Styles */
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        .about-section {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .about-section h2 {
            font-size: 2rem;
            color: #FF6F61;
            margin-bottom: 20px;
            text-align: center;
        }

        .about-section p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #333;
            margin-bottom: 20px;
        }

        .team-section {
            margin-top: 40px;
            text-align: center;
        }

        .team-section h3 {
            font-size: 1.8rem;
            color: #FF6F61;
            margin-bottom: 30px;
        }

        .team-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .team-member {
            width: 30%;
            padding: 10px;
            margin-bottom: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .team-member img {
            width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .team-member h4 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .team-member p {
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Header (Same as Home Page) -->
    <?php include('header.php'); ?>

    <div class="container">
        <!-- Company Overview Section -->
        <div class="about-section">
            <h2>About Ganapati Booking</h2>
            <p>Welcome to Ganapati Booking, your trusted platform for booking Ganapati murtis online. Our journey started with a mission to bring the blessings of Lord Ganesha to every home. With a rich history rooted in tradition and a vision to make the Ganapati festival accessible to everyone, we are proud to serve devotees across the globe.</p>
            <p>Our mission is to provide high-quality, artistically crafted Ganapati murtis while promoting eco-friendly practices. We believe in preserving the sanctity of the festival and ensuring that every devotee can celebrate with a murti that resonates with their devotion and values.</p>
        </div>

        <!-- Team Section -->
        <div class="team-section">
            <h3>Meet Our Team</h3>
            <div class="team-container">
                <!-- Team Member 1 -->
                <div class="team-member">
                    <img src="images/team1.jpg" alt="Team Member 1">
                    <h4>John Doe</h4>
                    <p>Founder & CEO</p>
                </div>
                <!-- Team Member 2 -->
                <div class="team-member">
                    <img src="images/team2.jpg" alt="Team Member 2">
                    <h4>Jane Smith</h4>
                    <p>Chief Operating Officer</p>
                </div>
                <!-- Team Member 3 -->
                <div class="team-member">
                    <img src="images/team3.jpg" alt="Team Member 3">
                    <h4>Robert Brown</h4>
                    <p>Head of Marketing</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (Same as Home Page) -->
    <?php include('footer.php'); ?>
</body>
</html>
