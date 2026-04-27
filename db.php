<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ecommerceg"; // Unified database name

// Enable error reporting for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8mb4");
} catch (\mysqli_sql_exception $e) {
     die("Connection failed: " . $e->getMessage());
}
?>