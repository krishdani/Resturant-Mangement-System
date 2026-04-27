<?php
session_start();
require_once 'db.php';

// Fetch all orders
$query = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f172a;
            --bg: #f8fafc;
            --border: #e2e8f0;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 240px;
            background: #1e293b;
            color: white;
            min-height: 100vh;
            padding: 20px;
            position: fixed;
        }
        .main-content {
            margin-left: 240px;
            padding: 40px;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        th {
            background: #f1f5f9;
            font-weight: 600;
            color: #475569;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-completed { background: #dcfce7; color: #16a34a; }
        
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li { padding: 12px; border-radius: 8px; margin-bottom: 5px; cursor: pointer; }
        .sidebar ul li:hover { background: #334155; }
        .sidebar a { color: inherit; text-decoration: none; display: block; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="productform.php">Upload Product</a></li>
            <li><a href="manageproduct.php">Manage Products</a></li>
            <li style="background: #334155;"><a href="orders.php">Orders</a></li>
            <li><a href="productfatch.php">View Store</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <h1>Customer Orders</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td>
                        <strong><?= htmlspecialchars($row['name']) ?></strong><br>
                        <small><?= htmlspecialchars($row['city']) ?>, <?= htmlspecialchars($row['state']) ?></small>
                    </td>
                    <td>₹<?= number_format($row['total'], 2) ?></td>
                    <td><?= htmlspecialchars($row['payment_mode']) ?></td>
                    <td>
                        <span class="status-badge status-<?= strtolower($row['status']) ?>">
                            <?= $row['status'] ?>
                        </span>
                    </td>
                    <td><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                </tr>
                <?php endwhile; ?>
                <?php if ($result->num_rows == 0): ?>
                <tr>
                    <td colspan="7" style="text-align:center; padding: 40px; color: #64748b;">No orders found yet.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
