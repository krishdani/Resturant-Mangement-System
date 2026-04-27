<?php
include('header.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title></title>
  <link rel="stylesheet" href="faq.css" />

</head>



<body>


  <section class="faq-section">
    <h2>Ordering & Shipping</h2>

    <div class="faq-item">
      <div class="faq-question"> I have placed an Order. How do I know if it’s confirmed?</div>
      <div class="faq-answer">
        Once your order has been placed, you will receive a confirmation Email and SMS. It will include your order number and estimated time of delivery.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Can I modify my order after I have placed it?</div>
      <div class="faq-answer">
        Unfortunately after the order is placed, you cannot add new products to the order but you can always place a new order for the desired products. If you wish to remove products from your order, please contact us at customer support to cancel the order so that a fresh order can be placed.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">How can I track my order?</div>
      <div class="faq-answer">
        You can track your order through multiple ways, mentioned below:
        -You can Login to our Website from your registered email address and track your order in "My Orders" section
        -You can track your order through the specific link sent to you via SMS and Email, after order is shipped.
        -You can connect with our Customer Care and we'll confirm you the tracking details with status
     </div>
    </div>

    <div class="faq-item">
      <div class="faq-question"> How long will my order take to arrive?</div>
      <div class="faq-answer">
        We aim at delivering the products as fast as we can. It generally takes 5-7 working days to fulfill the delivery. However, due to unforeseen circumstances like bad weather, flight delays, improper logistics infrastructure etc. the delivery might take longer.      </div>
    </div>

    <div class="faq-item">
        <div class="faq-question"> Can you expedite my product on priority?</div>
        <div class="faq-answer">
            The expedite delivery varies from region to region. If you want us to expedite your product, give us a call at customer support. Please make sure that it is a prepaid order. We cannot expedite the COD orders.        </div>
      </div>

  </section>

  <script src="faq.js"></script>
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