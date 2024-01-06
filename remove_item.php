<?php
session_start();
require_once 'db_connect.php';

$response = array(); // Initialize response array

if (isset($_GET['item_id'])) {
  $itemId = $_GET['item_id'];

  // Retrieve the item total price
  $selectQuery = "SELECT (qtyOrdered * price) AS itemTotalPrice FROM cart_items WHERE item_id =" . $itemId;
  $result = mysqli_query($conn, $selectQuery);
  $row = mysqli_fetch_assoc($result);
  $itemTotalPrice = $row['itemTotalPrice'];

  // Remove the item from the cart_items table
  $deleteQuery = "DELETE FROM cart_items WHERE item_id = $itemId";
  mysqli_query($conn, $deleteQuery);

  // Check if the deletion was successful
  if (mysqli_affected_rows($conn) > 0) {
    $response['success'] = true;
    $response['itemTotalPrice'] = $itemTotalPrice;
    echo json_encode($response);
  } else {
    $response['success'] = false;
    $response['error'] = "Failed to remove item";
    echo json_encode($response);
  }
}

mysqli_close($conn);
?>
