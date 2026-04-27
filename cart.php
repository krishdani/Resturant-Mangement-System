<?php
session_start();
require_once 'db.php';

$user_id = $_SESSION['user_id'] ?? 1;

// Use prepared statement to prevent SQL Injection
$stmt = $conn->prepare("
    SELECT cart.id AS cart_id, products.name, products.image, products.discount AS price, cart.quantity 
    FROM cart 
    JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = ?");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Header */


        /* Cart Container */
        .cart-container {
            width: 60%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Cart Items */
        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .cart-details {
            flex: 1;
        }

        .cart-details h2 {
            font-size: 18px;
            margin: 0;
        }

        .cart-price {
            color: #27ae60;
            font-weight: bold;
        }

        .remove-btn {
            background: #e74c3c;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background: #c0392b;
        }

        /* Cart Summary */
        .cart-summary {
            text-align: center;
            margin-top: 20px;
        }

        .cart-summary h2 {
            font-size: 22px;
        }

        .checkout-btn {
            background: #27ae60;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
        }

        .checkout-btn:hover {
            background: #219150;
        }
    </style>
</head>

<body>



    <div class="cart-container">
        <h1>Your Shopping Cart 🛒</h1>

        <div id="cart-items">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="cart-item">
                        <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                        <div class="cart-details">
                            <h2><?php echo $row['name']; ?></h2>
                            <p class="cart-price"><strong>Price:</strong> ₹<?php echo $row['price']; ?></p>
                            <p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>
                            <button class="remove-btn" onclick="removeFromCart(<?php echo $row['cart_id']; ?>)">Remove</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Your cart is empty 😔</p>
            <?php endif; ?>
        </div>

        <div class="cart-summary">
            <?php
            $total = 0;
            mysqli_data_seek($result, 0); // Reset pointer to loop again
            
            while ($row = $result->fetch_assoc()) {
                $total += $row['price'] * $row['quantity'];
            }


            ?>
            <h2>Total: ₹<span id="total-price"><?php echo number_format($total, 2); ?></span></h2>
            <button class="checkout-btn" Onclick="checkout()">Proceed to Checkout</button>
        </div>

    </div>

    <script>
        function removeFromCart(cartId) {
            fetch('remove_from_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'cart_id=' + cartId
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        alert('Failed to remove item');
                    }
                });
        }
    </script>

    <script>
        function checkout() {
            window.location.href = "checkout.php";
        }
    </script>

</body>
<?php
include('footer.php')
    ?>

</html>