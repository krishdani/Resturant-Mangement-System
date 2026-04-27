
<?php
include('header.php')
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Grit & Glow</title>
    <link rel="stylesheet" href="contact.css">
</head>


<body>
    <div class="container">
        <h1>Contact Us</h1>
        <p>We're here to help with all your skincare and grooming needs. Reach out to us!</p>

        <div class="contact-info">
            <p><strong>📍 Address:</strong> 123 Skincare Lane, Suite 100, New York, NY 10001</p>
            <p><strong>📧 Email:</strong> <a href="mailto:support@gritandglow12.com">support@gritandglow.com</a></p>
            <p><strong>📞 Phone:</strong> +1 (555) 123-4567</p>
            <p><strong>🕒 Support Hours:</strong> Mon-Fri: 9 AM - 6 PM (EST)</p>
        </div>

        <form action="#" method="POST" class="contact-form">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject">

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <div class="social-links">
            <p>Follow us:</p>
            <a href="#">Instagram</a> | 
            <a href="#">Facebook</a> | 
            <a href="#">Twitter</a>
        </div>
    </div>
</body>

<?php

 include('footer.php')
 ?>

</html>
<script>

    function updateCartCount() {
            fetch('cart_count.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.count;
            });
        }
    
        document.addEventListener('DOMContentLoaded', updateCartCount);
    
         // Load Cart Count
         function loadCartCount() {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                document.getElementById('cart-count').textContent = cart.length;
            }
    
            const btn = document.getElementById("productBtn");
  const dropdown = document.getElementById("productDropdown");
  const container = document.getElementById("dropdownContainer");

  container.addEventListener("mouseenter", () => {
    dropdown.style.display = "flex";
  });

  container.addEventListener("mouseleave", () => {
    dropdown.style.display = "none";
  });

    </script>