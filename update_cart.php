<?php
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = $_POST['product_id'];

// Check if the product already exists in the cart
$check_sql = "SELECT * FROM cart WHERE product_id = $product_id";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    // If product exists, increase quantity
    $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $product_id";
    $conn->query($update_sql);
    echo "Quantity Updated in Cart";
} else {
    // Fetch product details from products table
    $product_sql = "SELECT * FROM products WHERE id = $product_id";
    $product_result = $conn->query($product_sql);
    $product = $product_result->fetch_assoc();

    // Insert new product into cart
    $insert_sql = "INSERT INTO cart (product_id, product_name, price, quantity, image) 
                   VALUES ('$product_id', '{$product['name']}', '{$product['price']}', 1, '{$product['image']}')";
    
    if ($conn->query($insert_sql)) {
        echo "Product Added to Cart";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
