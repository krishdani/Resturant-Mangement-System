<?php

include('header.php');

$category = $_GET['category'] ?? 'facescrub';

$conn = new mysqli("localhost", "root", "", "ecommerceg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get sort parameter
$sort = $_GET['sort'] ?? '';
$orderBy = "";

if ($sort == 'asc') {
    $orderBy = "ORDER BY name ASC";
} elseif ($sort == 'desc') {
    $orderBy = "ORDER BY name DESC";
} elseif ($sort == 'low') {
    $orderBy = "ORDER BY discount ASC";
} elseif ($sort == 'high') {
    $orderBy = "ORDER BY discount DESC";
}

// Final query
$sql = "SELECT * FROM products WHERE category = ? $orderBy";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($category); ?> Products</title>
    <link rel="stylesheet" href="productfatch.css">
</head>
<style>
    .products-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 20px;
    padding: 20px;
    justify-items: center;
}

.product {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    width: 100%;
    max-width: 250px;
}

.product:hover {
    transform: scale(1.03);
}

.product img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    margin-bottom: 10px;
}

.product h2 {
    font-size: 18px;
    margin: 10px 0 5px;
}

.product h5 {
    font-size: 14px;
    color: #777;
    margin-bottom: 5px;
}

.product p {
    font-size: 15px;
    color: #333;
}


.select-wrapper {
  position: relative;
  display: inline-block;
}

.select-wrapper select {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  top: 25px;
  left: 0;
  z-index: 1000;
  transition: opacity 0.3s ease;
}

/* Show dropdown on hover */
.select-wrapper:hover select {
  visibility: visible;
  opacity: 1;
  pointer-events: auto;
}

</style>
<body>


<div class="main-content">

    <!-- Sort Dropdown -->
    <form method="GET" style="margin-bottom: 20px; position: relative;">
    <label for="sort" style="cursor: pointer;" onclick="toggleSortDropdown()">
        <img src="images/filter.png" alt="Filter Icon" style="vertical-align: middle; margin-right: 5px; height: 20px;">
        
    </label>
    
    <div id="sortDropdown" style="display: none;">
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="">-- Select --</option>
            <option value="asc" <?php if($sort == 'asc') echo 'selected'; ?>>Name (A–Z)</option>
            <option value="desc" <?php if($sort == 'desc') echo 'selected'; ?>>Name (Z–A)</option>
            <option value="low" <?php if($sort == 'low') echo 'selected'; ?>>Price: Low to High</option>
            <option value="high" <?php if($sort == 'high') echo 'selected'; ?>>Price: High to Low</option>
        </select>
    </div>

    <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
</form>

    <h2><?php echo htmlspecialchars($category); ?></h2>
    <div class="products-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<a href='product.php?id=" . $row['id'] . "'>";
                echo "<img src='images/" . $row['image'] . "' width='150' height='150'>";
                echo "<h2>" . $row['name'] . "</h2>";
                echo "</a>";
                echo "<h5>" . $row['category'] . "</h5>";
                echo "<p>Price: ₹" . $row['price'] . "</p>";
                echo "<p><b>Discounted Price: ₹" . $row['discount'] . "</b></p>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found in this category.</p>";
        }
        ?>
    </div>
</div>



    <script>
    
    function toggleSortDropdown() {
        const dropdown = document.getElementById('sortDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Optional: Close dropdown if user clicks outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('sortDropdown');
        const label = event.target.closest('label');

        if (!label && !event.target.closest('#sortDropdown')) {
            dropdown.style.display = 'none';
        }
    });


</script>

</body>
<?php

 include('footer.php')
 ?>
</html>
