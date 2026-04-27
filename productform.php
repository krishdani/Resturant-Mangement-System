
<?php
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_start(); // Prevent headers already sent issue
    include 'upload.php';
    ob_end_clean(); // We suppress direct echoes and use $message instead
}
?>


<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel</title>
  <style>* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
}

body {
  background-color: #f4f6f8;
}

.admin-container {
  display: flex;
  min-height: 100vh;
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
  flex: 1;
  padding: 40px;
}

.form-card {
  background-color: white;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  max-width: 700px;
  margin: 0 auto;
  animation: fadeIn 0.6s ease-in;
}

.form-card h2 {
  margin-bottom: 25px;
  color: #2f3e46;
}

.form-group {
  margin-bottom: 18px;
}

label {
  display: block;
  margin-bottom: 6px;
  font-weight: 600;
  color: #333;
}

input[type="text"],
input[type="number"],
select,
textarea {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 15px;
  transition: 0.3s;
}

input:focus,
select:focus,
textarea:focus {
  outline: none;
  border-color: #52796f;
  box-shadow: 0 0 6px rgba(82, 121, 111, 0.3);
}

textarea {
  resize: vertical;
  min-height: 80px;
}

button {
  padding: 12px 20px;
  background-color: #52796f;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 10px;
  transition: background-color 0.3s ease, transform 0.2s;
}

button:hover {
  background-color: #354f52;
  transform: translateY(-2px);
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }


}

.button-group {
  display: flex;
  justify-content: flex-start;
  gap: 15px;
  margin-top: 20px;
}

.reset-btn {
  background-color: #b00020;
  color: #fff;
  font-weight: bold;
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease, transform 0.2s;
}

.reset-btn:hover {
  background-color: #7f0000;
  transform: translateY(-2px);
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
  <div class="admin-container">
    <aside class="sidebar">
      <h2>Admin Panel</h2>
      <ul class="btn">
      <a href="dashboard.php" style="color: white; text-decoration: none;">
  <li>Dashboard</li>
</a>

        <a href="productform.php" style="color: white; text-decoration: none;"><li>Upload Product</li></a>
        <a href="manageproduct.php" style="color: white; text-decoration: none;"><li>Manage Products</li></a>
        
        <li>Orders</li>
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

        <a href="productfatch.php" style="color: white; text-decoration: none;"><li>G&G Main</li></a>

      </ul>
    </aside>

    <main class="main-content">
      <div class="form-card">
        <center><h2>Upload a New Product</h2></center>
        <form  method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Product Name:</label>
            <input type="text" name="name" required>
          </div>

          <div class="form-group">
            <label>Price:</label>
            <input type="number" name="price" required>
          </div>
          <div class="form-group">
            <label>Discount</label>
            <input type="number" name="discount">
          </div>

          <div class="form-group">
            <label>Brand:</label>
            <input type="text" name="brand">
          </div>

          <div class="form-group">
            <label>Category:</label>
            <select name="category1" required>
              <option value="">--Select Category--</option>
              <option value="Trending Products">Trending Products</option>
              <option value="Best Seller">Best seller</option>
              <option value="Popular Products">Popular Product</option>
              <option value="Summer Spacial">Summer Spacial</option>
            
              </select>
              </div>

              <div class="form-group">
            <label>Products:</label>
            <select name="category" required>
              <option value="">--Select Products--</option>
              <option value="Sunscreen">Sunscreen</option>
              <option value="FaceSerum">FaceSerum</option>
              <option value="FaceWash">FaceWash</option>
              <option value="FaceScrub">FaceScrub</option>
              <option value="FaceMask">FaceMask</option>
            </select>
          </div>

          <div class="form-group">
            <label>Description:</label>
            <textarea name="description"></textarea>
          </div>

          <div class="form-group">
            <label>Product Image:</label>
            <input type="file" name="image" required>
          </div>
          <div class="form-group">
            <label>Product Image 1:</label>
            <input type="file" name="image1" required>
          </div>
          <div class="form-group">
            <label>Product Image 2:</label>
            <input type="file" name="image2" required>
          </div>
          <div class="form-group">
            <label>Product Image 3:</label>
            <input type="file" name="image3" required>
          </div>

          <div class="button-group">
  <button type="submit" name="upload">Upload Product</button>
  <button type="reset" class="reset-btn">Reset</button>
 
</div>
<?php if (!empty($message)): ?>
  <p style="margin-top: 15px; font-weight: bold; color: green;">
    <?= htmlspecialchars($message) ?>
  </p>
<?php endif; ?>


        </form>
      </div>
    </main>
  </div>
</body>
</html>
