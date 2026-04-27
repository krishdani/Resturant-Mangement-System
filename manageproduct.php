<?php
$conn = new mysqli("localhost", "root", "", "ecommerceg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $conn->query("DELETE FROM cart WHERE product_id = $id");
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manageproduct.php");
    exit;
}

// Update product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
   
    $discount = $_POST['discount'];
    $category = $_POST['category'];
    $category1 = $_POST['category1'];
    $description = $_POST['description'];

    function uploadImage($field, $oldFile) {
        if (!empty($_FILES[$field]['name'])) {
            $target_dir = "images/";
            $filename = basename($_FILES[$field]["name"]);
            $target_file = $target_dir . $filename;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png'];
            if (in_array($imageFileType, $allowed)) {
                move_uploaded_file($_FILES[$field]["tmp_name"], $target_file);
                return $filename;
            }
        }
        return $oldFile;
    }

    $getOld = $conn->query("SELECT image, image1, image2, image3 FROM products WHERE id = $id");
    $old = $getOld->fetch_assoc();

    $image = uploadImage("image", $old['image']);
    $image1 = uploadImage("image1", $old['image1']);
    $image2 = uploadImage("image2", $old['image2']);
    $image3 = uploadImage("image3", $old['image3']);

    $stmt = $conn->prepare("UPDATE products SET name=?, brand=?, price=?, discount=?, category=?, category1=?, description=?, image=?, image1=?, image2=?, image3=? WHERE id=?");
    $stmt->bind_param("ssddsssssssi", $name, $brand, $price, $discount, $category, $category1, $description, $image, $image1, $image2, $image3, $id);

    $stmt->execute();

    header("Location: manageproduct.php");
    exit;
}

$editProduct = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    $editProduct = $result->fetch_assoc();
}

$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
        }

        .sidebar {
  width: 220px;
  background-color: #2f3e46;
  color: white;
  padding: 20px;
  position: fixed;
  height: 100%;
  top: 0;
  left: 0;
}

.sidebar h2 {
  font-size: 22px;
  margin-bottom: 30px;
}

.sidebar ul {
  list-style: none;
  padding: 0;
}

.sidebar ul li {
  padding: 12px 10px;
  margin-bottom: 8px;
  cursor: pointer;
  transition: background 0.3s ease;
  border-radius: 5px;
}

.sidebar ul li:hover {
  background-color: #354f52;
}


        .main-content {
            margin-left: 220px;
            padding: 20px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            margin: 20px auto;
            width: 600px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #333;
            color: #fff;
        }

        img {
            width: 60px;
        }

        .edit-btn {
            background: #2980b9;
            color: #fff;
            border: none;
            
        }

        .edit-btn a{
            text-decoration: none;
            color: white;
        }

        .delete-btn {
            background: #c0392b;
            color: #fff;
            border: none;
        }

        .dropdown-parent:hover .dropdown {
  display: block;
}

.dropdown {
  display: none;
  background-color: #354f52;
  margin-top: 5px;
  border-radius: 5px;
  padding-left: 10px;
}

.dropdown li {
  margin: 5px 0;
}

.dropdown li a {
  font-size: 14px;
  padding: 8px 10px;
  display: block;
  color: #f1f1f1;
}

    </style>
</head>
<body>
<aside class="sidebar">
  <h2>Admin Panel</h2>
  <ul>
  <a href="dashboard.php" style="color: white; text-decoration: none;">
  <li>Dashboard</li>
</a>

    <a href="productform.php" style="color: white; text-decoration: none;">
      <li>Upload Product</li>
    </a>
    <a href="manageproduct.php" style="color: white; text-decoration: none;">
      <li>Manage Products</li>
    </a>
    <a href="orders.php" style="color: white; text-decoration: none;">
      <li>Orders</li>
    </a>
    <a href="adminlogin.php?logout=true" style="color: white; text-decoration: none;">
  <li>Logout</li>
</a>

<li class="dropdown-parent">
      Manage Users
      <ul class="dropdown">
        <li><a href="adminusers.php">Admin Users</a></li>
        <li><a href="websiteusers.php">Website Users</a></li>
      </ul>
    </li>


    <a href="productfatch.php" style="color: white; text-decoration: none;">
     <li>G&G Main</li>
     </a>
  </ul>
</aside>


    <div class="main-content">
        <h2>Manage Products</h2>

        <?php if ($editProduct): ?>
        <div class="form-container">
            <h3>Edit Product</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $editProduct['id'] ?>">
                <label>Product Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($editProduct['name']) ?>" required>

                <label>Brand:</label>
                <input type="text" name="brand" value="<?= htmlspecialchars($editProduct['brand']) ?>">

                <label>Price:</label>
                <input type="number" name="price" value="<?= $editProduct['price'] ?>" required>

                <label>Discounted Price:</label>
                <input type="number" name="discount" value="<?= $editProduct['discount'] ?>">

                <label>Category</label>
                <select name="category1">
                    <option value="Trending Products" <?= $editProduct['category1'] == 'Trending Products' ? 'selected' : '' ?>>Trending Products</option>
                    <option value="Best Seller" <?= $editProduct['category1'] == 'Best Seller' ? 'selected' : '' ?>>Best Seller</option>
                    <option value="Popular Products" <?= $editProduct['category1'] == 'Popular Products' ? 'selected' : '' ?>>Popular Products</option>
                    <option value="Summer Spacial" <?= $editProduct['category1'] == 'Summer Spacial' ? 'selected' : '' ?>>Summer Spacial</option>
                \
                </select>

                <label>Products</label>
                <select name="category">
                   
                    <option value="Sunscreen" <?= $editProduct['category'] == 'Sunscreen' ? 'selected' : '' ?>>Sunscreen</option>
                    <option value="FaceSerum" <?= $editProduct['category'] == 'FaceSerum' ? 'selected' : '' ?>>FaceSerum</option>
                    <option value="FaceWash" <?= $editProduct['category'] == 'FaceWash' ? 'selected' : '' ?>>FaceWash</option>
                    <option value="FaceScrub" <?= $editProduct['category'] == 'FaceScrub' ? 'selected' : '' ?>>FaceScrub</option>
                    <option value="FaceMask" <?= $editProduct['category'] == 'FaceMask' ? 'selected' : '' ?>>FaceMask</option>
                </select>

                <label>Description:</label>
                <textarea name="description"><?= htmlspecialchars($editProduct['description']) ?></textarea>

                <label>Product Image:</label>
                <input type="file" name="image">

                <label>Product Image 1:</label>
                <input type="file" name="image1">

                <label>Product Image 2:</label>
                <input type="file" name="image2">

                <label>Product Image 3:</label>
                <input type="file" name="image3">

                <button type="submit" name="update">Update Product</button>
            </form>
        </div>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Price</th>
                
                <th>Discounted Price</th>
                <th>Category</th>
                <th>Products</th>

                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $products->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['brand']) ?></td>
                <td>₹<?= $row['price'] ?></td>
               
                <td>₹<?= $row['discount'] ?></td>
                <td><?= htmlspecialchars($row['category1']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>

                <td><img src="images/<?= $row['image'] ?>" alt=""></td>
                <td>
                    <a href="manageproduct.php?edit=<?= $row['id'] ?>" style="text-decoration: none;" >
                        <button class="edit-btn" type="button">Edit</button>
                        </a>
                        
                    
                    <form method="POST" action="manageproduct.php" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="delete-btn">Delete</button>

                    </form>
                    
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
