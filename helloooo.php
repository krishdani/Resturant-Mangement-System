
CREATE DATABASE ecommerce;
USE ecommerce;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    brand VARCHAR(255),
    price DECIMAL(10,2),
    old_price DECIMAL(10,2),
    discount INT,
    image VARCHAR(255),
    description TEXT,
    reviews INT
);

INSERT INTO products (name, brand, price, old_price, discount, image, description, reviews) VALUES
('The Man Company Charcoal Tan Removal Face Scrub', 'The Man Company', 237, 350, 32, '.jpg', 
'Gentle exfoliating face scrub with activated charcoal for deep cleansing and acne control.', 2223);





new

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['upload'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Handle file upload
    $target_dir = "uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Allow only JPG, JPEG, PNG
    $allowed_types = ["jpg", "jpeg", "png"];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Only JPG, JPEG, PNG files are allowed.");
    }

    // Move the uploaded file to the uploads folder
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert data into database
        $sql = "INSERT INTO products (name, price, discount_price, image, brand, category, description)
                VALUES ('$name', '$price', '$discount_price', '$image_name', '$brand', '$category', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "Product uploaded successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>



form vadu product mate 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
</head>
<body>
    <h2>Upload a New Product</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required><br>

        <label>Price:</label>
        <input type="number" name="price" required><br>

        <label>Discount Price:</label>
        <input type="number" name="discount_price"><br>

        <label>Brand:</label>
        <input type="text" name="brand"><br>

        <label>Category:</label>
        <input type="text" name="category"><br>

        <label>Description:</label>
        <textarea name="description"></textarea><br>

        <label>Product Image:</label>
        <input type="file" name="image" required><br>

        <button type="submit" name="upload">Upload Product</button>
    </form>
</body>
</html>


product on website #<?php
$conn = new mysqli("localhost", "root", "", "ecommerce");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='product'>";
    echo "<img src='uploads/" . $row['image'] . "' width='150' height='150'>";
    echo "<h2>" . $row['name'] . "</h2>";
    echo "<p>Price: <del>₹" . $row['price'] . "</del> ₹" . $row['discount_price'] . "</p>";
    echo "<a href='product_details.php?id=" . $row['id'] . "'>View Details</a>";
    echo "</div>";
}

$conn->close();
?>



<a href="product_details.php?id=<?php echo $row['id']; ?>">
    <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
    <h2><?php echo $row['name']; ?></h2>
</a>


<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id']; // Get the product ID from the URL
    echo "Product ID: " . $product_id;
} else {
    echo "No product selected!";
}
?>

fetch

<?php
$conn = new mysqli("localhost", "root", "", "ecommerce");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Convert to integer for security

    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo "<h1>" . $product['name'] . "</h1>";
        echo "<img src='uploads/" . $product['image'] . "' width='300'>";
        echo "<p>Price: ₹" . $product['price'] . "</p>";
        echo "<p>Description: " . $product['description'] . "</p>";
    } else {
        echo "Product not found!";
    }
} else {
    echo "No product selected!";
}

$conn->close();
?>



<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details from database
$product_id = $_GET['id']; // Get product ID from URL
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="product-container">
        <img src="<?php echo $product['image']; ?>" alt="Product Image">
        <h2><?php echo $product['name']; ?></h2>
        <p>Price: ₹<?php echo $product['price']; ?></p>
       <button class="add-to-cart" data-id="<?php echo $product['id']; ?>">Add to Cart</button> 
    </div>

    <script src="script.js"></script>
</body>
</html>
