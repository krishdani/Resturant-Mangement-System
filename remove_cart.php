<?php
include 'db.php';
session_start();

if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];
    $query = "DELETE FROM cart WHERE id = '$cart_id'";
    mysqli_query($conn, $query);
}

header("Location: cart1.php");
?>
