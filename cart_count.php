<?php
session_start();
require_once 'db.php';

$user_id = $_SESSION['user_id'] ?? 1;

// Sum the quantities for a total item count
$stmt = $conn->prepare("SELECT SUM(quantity) AS count FROM cart WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo json_encode(["count" => $row['count'] ?? 0]);
?>
