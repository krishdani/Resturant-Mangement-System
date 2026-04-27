
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
    <h2>Cancellations & Refunds</h2>

    <div class="faq-item">
      <div class="faq-question">  How can I cancel my order?</div>
      <div class="faq-answer">
        An order once placed, can be cancelled only within 2 hours. To cancel your order please write to us at care </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Can I modify my shipping address after the order has been placed?</div>
      <div class="faq-answer">
        Yes, we can modify/change your shipping address provided you contact us within 4 hours of placing your order. However, if the order is processed before you contact us the shipping address will not be modified/changed.      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">How will I get refund for the cancelled order?</div>
      <div class="faq-answer">
        Refunds of cancelled orders will be done only in the form of gift card.To get your refund please contact us at our customer support at care@themancompany.com. 
     </div>
    </div>

    <div class="faq-item">
      <div class="faq-question"> Return and Exchange policy</div>
      <div class="faq-answer">
        Due to hygiene reasons we cannot accept exchange or returns on our products. 
        If you ever have any questions regarding our refunds & exchange, please contact us at  care@themancompany.com.
        In case of damaged/wrong products, contact must be made within 3 days of receiving the products by notifying us at care@themancompany.com. In such a case, we will send you the replacement of the damaged product. If a refund is needed, it will be done only in the form of a Gift Card.    </div>

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