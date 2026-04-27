<?php
session_start();
require_once 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Secure query with prepared statement
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("Product not found");
}

include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="product.css">
</head>

<body>
    <div class="product-container">
        <div class="product-gallery">
            <img id="mainImage" src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
            <div class="thumbnails">
                <?php if (!empty($product['image1'])): ?>
                    <img src="images/<?php echo htmlspecialchars($product['image1']); ?>" alt="Product Image" onclick="changeImage(this)">
                <?php endif; ?>
                <?php if (!empty($product['image2'])): ?>
                    <img src="images/<?php echo htmlspecialchars($product['image2']); ?>" alt="Product Image" onclick="changeImage(this)">
                <?php endif; ?>
                <?php if (!empty($product['image3'])): ?>
                    <img src="images/<?php echo htmlspecialchars($product['image3']); ?>" alt="Product Image" onclick="changeImage(this)">
                <?php endif; ?>
            </div>
        </div>

        <div class="product-details">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <p><strong>Brand:</strong> <?php echo htmlspecialchars($product['brand'] ?? 'N/A'); ?></p>

            <div class="rating">
                ⭐⭐⭐⭐☆ (4.0)
            </div>

            <p class="price">
                <strong>₹<?php echo number_format($product['discount'], 2); ?></strong>   
                <span style="text-decoration: line-through; color: #888; margin-left:10px;">₹<?php echo number_format($product['price'], 2); ?></span>
            </p>

            <p class="offer">📢 Apply 3% coupon | Cashback & Bank Offers Available</p>

            <h3>Size:</h3>
            <div class="size-options">
                <button class="size-btn active">Default Pack</button>
            </div>

            <h3>About this item:</h3>
            <p class="description"><?php echo nl2br(htmlspecialchars($product['description'] ?? '')); ?></p>

            <!-- Add to Cart Button -->
            <button class="add-to-cart" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
            <button class="buy-now" onclick="buyNow(<?php echo $product['id']; ?>)">BUY NOW</button>
        </div>
    </div>

    <div class="main-content">
        <div class='category-section'>
            <h2>Trending Products</h2>
            <div class='product-container' style="display: flex; flex-wrap: wrap; gap: 20px;">
                <?php
                $cat_stmt = $conn->prepare("SELECT * FROM products WHERE category1 = 'Trending Products' AND id != ? LIMIT 4");
                $cat_stmt->bind_param("i", $id);
                $cat_stmt->execute();
                $related = $cat_stmt->get_result();

                while ($row = $related->fetch_assoc()): ?>
                    <div class='product' style="border: 1px solid #ddd; padding: 15px; border-radius: 10px; text-align: center; flex: 1; min-width: 200px;">
                        <a href='product.php?id=<?= $row['id'] ?>'>
                            <img src='images/<?= htmlspecialchars($row['image']) ?>' width='150' height='150' style="object-fit: contain;">
                            <h3 style="font-size: 16px; margin: 10px 0;"><?= htmlspecialchars($row['name']) ?></h3>
                        </a>
                        <p>₹<?= number_format($row['discount'], 2) ?></p>
                        <button class="add-to-cart-sm" onclick="addToCart(<?= $row['id'] ?>)">Add to Cart</button>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script>
        function addToCart(productId, showAlert = true) {
            let formData = new FormData();
            formData.append('product_id', productId);

            return fetch('add_to_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    if (showAlert) showToast('Product added to cart!');
                    if (typeof updateCartCount === 'function') updateCartCount();
                    return true;
                } else {
                    alert('Failed to add to cart');
                    return false;
                }
            })
            .catch(err => {
                console.error('Error:', err);
                return false;
            });
        }

        async function buyNow(productId) {
            const success = await addToCart(productId, false);
            if (success) {
                window.location.href = 'checkout.php';
            }
        }

        function changeImage(element) {
            document.getElementById('mainImage').src = element.src;
        }

        function showToast(message) {
            // Simple toast implementation
            alert(message);
        }
    </script>
    <script src="productdes.js"></script>
</body>
<?php include('footer.php'); ?>
</html>
