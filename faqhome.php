<?php
include('header.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQs</title>
  <link rel="stylesheet" href="faqhome.css" />
  

</head>
<body>
  
  <section class="faq-grid">
    
    <a href="faq.php" class="faq-box">
      <img src="images/truck.png" alt="Ordering & Shipping">
      <p>Ordering & Shipping</p>
    </a>

    <a href="cancelfaq.php" class="faq-box">
      <img src="images/refaq.png" alt="Cancellations & Refunds">
      <p>Cancellations & Refunds</p>
    </a>

    <a href="feedbackfaq.php" class="faq-box">
      <img src="images/setting.png" alt="Support & Feedback">
      <p>Support & Feedback</p>
    </a>

  </section>
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

       
</script>