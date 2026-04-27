<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerceg";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message
$message = "";

if (isset($_POST['upload'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $category1 = $_POST['category1'];
    $description = $_POST['description'];

    $target_dir = "images/";
    $image_name = basename($_FILES["image"]["name"]);
    $image_name1 = basename($_FILES["image1"]["name"]);
    $image_name2 = basename($_FILES["image2"]["name"]);
    $image_name3 = basename($_FILES["image3"]["name"]);

    $target_file = $target_dir . $image_name;
    $target_file1 = $target_dir . $image_name1;
    $target_file2 = $target_dir . $image_name2;
    $target_file3 = $target_dir . $image_name3;

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["jpg", "jpeg", "png"];

    if (!in_array($imageFileType, $allowed_types)) {
        $message = "Only JPG, JPEG, PNG files are allowed.";
    } else {
        if (
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file) &&
            move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file1) &&
            move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file2) &&
            move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file3)
        ) {
            $sql = "INSERT INTO products (name, price, category, category1, discount, image, image1, image2, image3, brand, description)
                    VALUES ('$name', '$price', '$category','$category1', '$discount', '$image_name', '$image_name1', '$image_name2', '$image_name3', '$brand', '$description')";

            if ($conn->query($sql) === TRUE) {
                $message = "Product uploaded successfully!";
            } else {
                $message = "Database error: " . $conn->error;
            }
        } else {
            $message = "Error uploading file(s).";
        }
    }
}

$conn->close();
?>
