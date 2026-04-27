<?php
// admin_users.php
$conn = new mysqli("localhost", "root", "", "ecommerceg");

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM admin WHERE id = $delete_id");
    header("Location: adminusers.php");
    exit;
}

// Fetch all admins
$result = $conn->query("SELECT * FROM admin");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Users</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            padding: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #2f3e46;
            color: white;
        }
        .btn-delete {
            padding: 6px 12px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn-delete:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <h2>Admin Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Admin ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['admin_id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['password'] ?></td>
                <td>
                    <a class="btn-delete" href="adminusers.php?delete_id=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
