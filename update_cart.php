<?php
session_start();
require_once 'db_connect.php';

// Check if the required parameters are present
if (isset($_GET['itemId']) && isset($_GET['quantity'])) {
  // Retrieve the updated quantities from the URL parameters
  $itemId = $_GET['itemId'];
  $quantity = $_GET['quantity'];

  // Update the cart_items table with the new quantity
  $updateQuery = "UPDATE cart_items SET qtyOrdered = $quantity WHERE item_id = $itemId";
  mysqli_query($conn, $updateQuery);

  // Calculate the new total amount
  $selectQuery = "SELECT SUM(ci.qtyOrdered * i.price) AS totalAmount
                  FROM cart_items ci
                  INNER JOIN items i ON ci.item_id = i.id";
  $result = mysqli_query($conn, $selectQuery);
  $row = mysqli_fetch_assoc($result);
  $totalAmount = $row['totalAmount'];

  // Return a response indicating success and the new total amount
  $response = array(
    'success' => true,
    'totalAmount' => $totalAmount
  );
  echo json_encode($response);
} else {
  // Return a response indicating an error
  $response = array(
    'success' => false,
    'error' => 'Invalid parameters'
  );
  echo json_encode($response);
}

mysqli_close($conn);
?>
