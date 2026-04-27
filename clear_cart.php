<?php
session_start();
unset($_SESSION['cart']); // Clear cart session
header("Location: cart.php");
exit();
?>
