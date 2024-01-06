<?php
session_start();
require_once 'db_connect.php';

// Get item_id, item_price, and item_stock from the GET parameters
$item_id = $_GET["item_id"];
$item_price = $_GET["item_price"];
$item_stock = $_GET["item_stock"];
$item_qtyOrdered = 1;

// Escape the strings to prevent SQL injection
$item_id = mysqli_real_escape_string($conn, $item_id);
$item_price = mysqli_real_escape_string($conn, $item_price);
$item_stock = mysqli_real_escape_string($conn, $item_stock);

// Insert the data into the cart_items table
$sql = "INSERT INTO cart_items (item_id, price, qtyOrdered, stock) VALUES ('$item_id', '$item_price', '$item_qtyOrdered' , '$item_stock')";
if ($conn->query($sql) === TRUE) {
    echo "Item added to cart successfully";
} else {
    echo "Error adding item to cart";
}

session_abort();
mysqli_close($conn);
?>
