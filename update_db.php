<?php
include 'db.php';

$sql = "ALTER TABLE orders 
        ADD COLUMN IF NOT EXISTS address TEXT, 
        ADD COLUMN IF NOT EXISTS city VARCHAR(100), 
        ADD COLUMN IF NOT EXISTS state VARCHAR(100), 
        ADD COLUMN IF NOT EXISTS zip VARCHAR(20), 
        ADD COLUMN IF NOT EXISTS phone VARCHAR(20)";

if ($conn->query($sql) === TRUE) {
    echo "Database updated successfully";
} else {
    echo "Error updating database: " . $conn->error;
}
?>
