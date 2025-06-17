<style>
/* Footer Styles */
footer {
    background-color: #333;
    color: white;
    padding: 50px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

.container {
    width: 90%;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
}

.footer-section {
    flex: 1;
    margin: 20px;
    min-width: 200px;
}

.footer-section h3 {
    margin-bottom: 20px;
    font-size: 1.2rem;
    border-bottom: 2px solid #FFD700;
    padding-bottom: 10px;
    color: #FFD700;
}

.quick-links ul {
    list-style: none;
    padding: 0;
}

.quick-links ul li {
    margin-bottom: 10px;
}

.quick-links ul li a {
    color: white;
    text-decoration: none;
    transition: color 0.3s ease;
}

.quick-links ul li a:hover {
    color: #FFD700;
}

.social-media a {
    margin-right: 15px;
    transition: transform 0.3s ease;
}

.social-media a:hover {
    transform: scale(1.2);
}

.social-icon {
    width: 30px;
    height: 30px;
}

.contact-info p {
    margin: 10px 0;
}

.contact-info a {
    color: #FFD700;
    text-decoration: none;
}

.contact-info a:hover {
    text-decoration: underline;
}

/* Responsive Footer */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
    }

    .footer-section {
        margin: 10px 0;
    }
}

</style>
<footer class="footer">
    <div class="container">
        <!-- Quick Links -->
        <div class="footer-section quick-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="terms.php">Terms & Conditions</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
            </ul>
        </div>

        <!-- Social Media Icons -->
        <div class="footer-section social-media">
            <h3>Follow Us</h3>
            <a href="#"><img src="images/facebook.png" alt="Facebook" class="social-icon"></a>
            <a href="#"><img src="images/instagram.png" alt="Instagram" class="social-icon"></a>
            <a href="#"><img src="images/twitter.png" alt="Twitter" class="social-icon"></a>
            <a href="#"><img src="images/linkedin.png" alt="LinkedIn" class="social-icon"></a>
        </div>

        <!-- Contact Info -->
        <div class="footer-section contact-info">
            <h3>Contact Info</h3>
            <p>Email: <a href="mailto:support@ganapatibooking.com">support@ganapatibooking.com</a></p>
            <p>Phone: <a href="tel:+911234567890">+91 12345 67890</a></p>
            <p>&copy; 2024 Ganapati Booking. All Rights Reserved.</p>
        </div>
    </div>
</footer>
