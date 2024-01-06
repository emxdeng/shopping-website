<?php
session_start();
require_once 'db_connect.php';

// Clear the cart_items table
$query = "DELETE FROM cart_items";
mysqli_query($conn, $query);

mysqli_close($conn);
?>
