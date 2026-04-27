<?php
include('header.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Grit & Glow</title>
  <style>
    /* General Styling */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
      color: #333;
      text-align: center;
    }

    
    /* Section Styling */
    section {
      padding: 40px 20px;
      max-width: 800px;
      margin: auto;
      text-align: left;
      background-color: white;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    /* Team Section */
    .team-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .member {
      flex: 1;
      padding: 10px;
      text-align: center;
      background-color: #f0f0f0;
      margin: 5px;
      border-radius: 5px;
    }

    /* Why Choose Us Section */
    .why-choose-us ul {
      list-style: none;
      padding: 0;
    }

    .why-choose-us li {
      background-color: #ddd;
      padding: 10px;
      margin: 5px 0;
      border-radius: 5px;
    }

    
  </style>
</head>
<body>
  

  <section class="about">
    <h2>Our Story</h2>
    <p>Grit & Glow was founded with a mission – to provide high-quality, natural skincare solutions tailored for men. Our journey began with a simple idea: skincare should be <em>effective, effortless, and empowering</em>.</p>
  </section>

  <section class="mission">
    <h2>Our Mission</h2>
    <p>We believe <em>men deserve great skincare</em>. Our mission is to create <strong>natural, cruelty-free, and dermatologist-approved products</strong> that fit seamlessly into your daily routine.</p>
  </section>

  <section class="team">
    <h2>Meet Our Team</h2>
    <div class="team-container">
      <div class="member">
        <h3>Mr.Smit Variya</h3>
        <p>CEO</p>
      </div>
      <div class="member">
        <h3>Ms.Vaishnavi Parikh</h3>
        <p>Skincare Expert</p>
      </div>
      <div class="member">
        <h3>Mr.Krish Dani</h3>
        <p>Founder</p>
      </div>
    </div>
  </section>

  <section class="why-choose-us">
    <h2>Why Choose Grit & Glow?</h2>
    <ul>
      <li>✔ 100% Natural Ingredients</li>
      <li>✔ Dermatologist-Approved</li>
      <li>✔ Cruelty-Free & Eco-Friendly</li>
      <li>✔ Tailored for Men's Skin</li>
    </ul>
  </section>

 

  <script>
    // Optional: Update cart count via PHP or localStorage
    function updateCartCount() {
      fetch('cart_count.php')
        .then(response => response.json())
        .then(data => {
          document.getElementById('cart-count').textContent = data.count;
        });
    }

    document.addEventListener('DOMContentLoaded', updateCartCount);
  </script>
</body>
<?php

 include('footer.php')
 ?>
</html>
