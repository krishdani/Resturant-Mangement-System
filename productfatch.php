<?php
session_start();
require_once 'db.php';

// Track visitors securely
if (!isset($_SESSION['visitor_tracked'])) {
    $_SESSION['visitor_tracked'] = true;
    $ip = $_SERVER['REMOTE_ADDR'];
    // Assuming 'traffic' table exists from earlier code
    try {
        $stmt = $conn->prepare("INSERT INTO traffic (ip_address) VALUES (?)");
        $stmt->bind_param("s", $ip);
        $stmt->execute();
    } catch (Exception $e) { /* Table might not exist yet, ignore silenty in this POC */ }
}

include('header.php');
?>

<link rel="stylesheet" href="productfatch.css">

<body>
    <section class="hero" id="home">
        <!-- Hero content can go here -->
    </section>

    <!-- Category Image Section -->
    <section class="imgcategory" style="display: flex; justify-content: center; gap: 20px; padding: 40px 20px;">
        <?php
        $img_cats = [
            ['link' => 'Sunscreen.php', 'img' => 'sunscreen_bg.png', 'name' => 'Sunscreen'],
            ['link' => 'faceserum.php', 'img' => 'serumm_bg.png', 'name' => 'FaceSerum'],
            ['link' => 'facewash.php', 'img' => 'facewash_bg.png', 'name' => 'FaceWash'],
            ['link' => 'facescrub.php', 'img' => 'facescrub_bg.png', 'name' => 'FaceScrub'],
            ['link' => 'facemask.php', 'img' => 'facemask_bg.png', 'name' => 'FaceMask'],
        ];
        foreach ($img_cats as $c): ?>
            <div class="imgcategory-container" style="text-align: center;">
                <a href="<?= $c['link'] ?>" style="text-decoration: none; color: inherit;">
                    <img src="images/<?= $c['img'] ?>" alt="<?= $c['name'] ?>" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #eee; transition: all 0.3s;" onmouseover="this.style.borderColor='#ca8a04'" onmouseout="this.style.borderColor='#eee'">
                    <span style="display: block; margin-top: 10px; font-weight: 500;"><?= $c['name'] ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </section>

    <div class="main-content" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <?php
        $categories = ["Trending Products", "Best Seller", "Popular Products", "Summer Spacial"];
        foreach ($categories as $cat) {
            $anchor = strtolower(str_replace(' ', '-', $cat));
            echo "<div class='category-section' id='$anchor' style='margin-bottom: 60px;'>";
            echo "<h2 style='font-size: 2rem; margin-bottom: 2rem; border-left: 5px solid #ca8a04; padding-left: 15px;'>$cat</h2>";
            echo "<div class='products-container' style='display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;'>";

            $stmt = $conn->prepare("SELECT * FROM products WHERE category1 = ?");
            $stmt->bind_param("s", $cat);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class='product'>
                        <a href='product.php?id=<?= $row['id'] ?>' style="text-decoration: none; color: inherit;">
                            <img src='images/<?= htmlspecialchars($row['image']) ?>' alt='<?= htmlspecialchars($row['name']) ?>' style="width: 100%; height: 200px; object-fit: contain;">
                            <h3 style="margin: 15px 0 5px; font-size: 1.1rem; height: 1.2em; overflow: hidden;"><?= htmlspecialchars($row['name']) ?></h3>
                        </a>
                        <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 15px;"><?= htmlspecialchars($row['category1']) ?></p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <p style="font-weight: 700; font-size: 1.2rem; color: #ca8a04; margin: 0;">₹<?= number_format($row['discount'], 2) ?></p>
                            <button onclick="addToCart(<?= $row['id'] ?>)" style="background: #0f172a; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer;">Add</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No products found in this category.</p>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        function addToCart(productId) {
            let formData = new FormData();
            formData.append('product_id', productId);
            fetch('add_to_cart.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Product added to cart!');
                        if (typeof updateCartCount === 'function') updateCartCount();
                    } else {
                        alert('Failed to add to cart');
                    }
                });
        }
    </script>
</body>
<?php include('footer.php'); ?>
</html>
