<?php
$conn = new mysqli("localhost", "root", "", "ecommerceg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT COUNT(*) AS total_visits FROM traffic");
$row = $result->fetch_assoc();
$total_visits = $row['total_visits'];
?>




<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
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

    .sidebar ul li:hover,
    .sidebar ul li.active0 {
      background-color: #354f52;
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


    .content {
      margin-left: 240px;
      padding: 30px;
    }

    .card {
      background: white;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 8px;
      padding-left: 20%;
    }

    .card h3 {
      margin-top: 0;
      color: black;
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


      <a href="productfatch.php" style="color: white; text-decoration: none;"><li>G&G Main</li></a>
    </ul>
  </aside>

  <div class="card">
    <h2>Website Traffic</h2>
  <h3>Total Visitors: <?php echo $total_visits;?></h3>
  
</div>




</body>
</html>

<?php $conn->close(); ?>
