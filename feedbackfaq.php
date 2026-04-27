<?php
include('header.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQ - Urban Skin Care</title>
  <link rel="stylesheet" href="faq.css" />



</head>




<body>


  <section class="faq-section">
    <h2>Support & Feedback</h2>

    <div class="faq-item">
      <div class="faq-question">  I want to give feedback, how shall I do that?</div>
      <div class="faq-answer">
        you can give a rating through feedback star  </div>
    </div>

    <div class="faq-item">
      <div class="faq-question"> How can I get in touch with a customer care executive?</div>
      <div class="faq-answer">
        you can contact us using  <a href="contact.html">contact us page</a></div>
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