<?php
$conn = new mysqli("localhost", "root", "", "ecommerceg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if product ID is provided
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details from database
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found!";
        exit;
    }
} else {
    echo "Invalid product ID!";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <img src="images/<?php echo $product['image']; ?>" width="300" height="300">
    <p><strong>Brand:</strong> <?php echo $product['brand']; ?></p>
    <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
    <p><strong>Price:</strong> <del>₹<?php echo $product['price']; ?></del></del>₹<?php echo $product['discount']; ?></p>
    <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
</body>
</html>
