<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">Grit & Glow</div>
        <div class="footer-links">
            <a href="index.php">Home</a>
            <a href="aboutus.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="faqhome.php">Help</a>
        </div>
        <div class="footer-contact">
            <p><strong>Email:</strong> gritandglow12@gmail.com</p>
            <p><strong>Phone:</strong> +91 98471 26414</p>
            <div class="socials">
                <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/facebook-new.png" alt="Facebook"/></a>
                <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/instagram-new.png" alt="Instagram"/></a>
                <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/twitter.png" alt="X"/></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Grit & Glow Co. All Rights Reserved.</p>
    </div>
</footer>

<style>
    .footer {
        background: #0f172a;
        color: #f8fafc;
        padding: 4rem 2rem 2rem;
        margin-top: 4rem;
    }
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
    }
    .footer-logo {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: -0.5px;
    }
    .footer-links {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        transition: color 0.2s;
    }
    .footer-links a:hover {
        color: #ca8a04;
    }
    .footer-contact p {
        color: #94a3b8;
        margin-bottom: 0.5rem;
    }
    .socials {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }
    .footer-bottom {
        max-width: 1200px;
        margin: 3rem auto 0;
        padding-top: 2rem;
        border-top: 1px solid #1e293b;
        text-align: center;
        color: #64748b;
        font-size: 0.875rem;
    }
</style>