

<?php

include 'head.php';
include 'header.php';

// Connect to the database and start the session
require_once 'db_connect.php';
session_start();

// Retrieve the data from the cart_items table, where cart and grocery items tables are joined
$query_string = "SELECT ci.item_id, ci.price, ci.qtyOrdered, i.name AS item_name, i.price AS item_price
FROM cart_items ci
INNER JOIN items i ON ci.item_id = i.id";

$result = mysqli_query($conn, $query_string);

// Check if the query executed successfully
if (!$result) {
  echo 'Error executing the query: ' . mysqli_error($conn);
  exit;
}

// Check if the query returned any rows
if (mysqli_num_rows($result) === 0) {
  echo 'No rows returned from the query.';
  exit;
}

$totalAmount = 0;
$individualPrices = []; // Array to store individual item prices
$itemNames = array();

while ($row = mysqli_fetch_assoc($result)) {
  // Access the columns of each row
  $itemId = $row['item_id'];
  $quantity = $row['qtyOrdered'];
  $itemPrice = $row['item_price'];
  $itemName = $row['item_name'];
  $itemNames[] = $itemName;

  // Store the individual item price in the array
  $individualPrices[] = $itemPrice;

  // Update the total amount
  $totalAmount += $itemPrice * $quantity;

  // Display the price for each individual item in the email message
  $message .= 'Item: ' . $itemName . ' | Price: ' . $itemPrice . ' | Quantity: ' . $quantity . PHP_EOL;
}

// Display the overall total price in the email message
$message .= 'Total Price: ' . $totalAmount . PHP_EOL;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $firstName = $_POST['first-name'];
  $lastName = $_POST['last-name'];
  $deliveryAddress = $_POST['delivery-address'];
  $suburb = $_POST['suburb'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $email = $_POST['email'];

  // Validate the form data
  if (empty($firstName) || empty($lastName) || empty($deliveryAddress) || empty($email)) {
    // Handle incomplete form data
    echo 'Please fill in all required fields.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Handle invalid email address
    echo 'Please enter a valid email address.';
  } else {
    // Place the order and send confirmation email
    $date = date('Y-m-d H:i:s');

    // Send confirmation email
    $subject = 'Order Confirmation';
    $message = 'Thank you for your order!' . PHP_EOL;
    $message .= 'Order Details:' . PHP_EOL;
    $message .= 'Date: ' . $date . PHP_EOL;
    $message .= 'First Name: ' . $firstName . PHP_EOL;
    $message .= 'Last Name: ' . $lastName . PHP_EOL;
    $message .= 'Delivery Address: ' . $deliveryAddress . PHP_EOL;
    $message .= 'Suburb: ' . $suburb . PHP_EOL;
    $message .= 'State: ' . $state . PHP_EOL;
    $message .= 'Country: ' . $country . PHP_EOL;
    $message .= 'Email: ' . $email . PHP_EOL;
    $message .= 'Total Price: ' . $totalAmount . PHP_EOL;
    // Display the individual prices
    foreach ($individualPrices as $index => $individualPrice) {
      $message .= 'Item ' . ($index + 1) . ': ' . $itemNames[$index] . ' | Price: ' . $individualPrice . PHP_EOL;
    }
    // Inside the confirmation message
    $message .= 'Total Price: ' . $totalAmount . PHP_EOL;

    echo '<div class="confirmation-msg">';
    // Send the email
    $headers = 'From: confirmation@yarnworths.com' . PHP_EOL; // Replace with your email address
    if (mail($email, $subject, $message, $headers)) {
      echo 'Order placed successfully. Confirmation email sent.';

      echo '<br><br>';
      echo $subject . "<br>";
      echo 'Thank you for your order! <br>';
      echo 'Order Details:<br>';
      echo 'Date: ' . $date . '<br>';
      echo 'First Name: ' . $firstName . '<br>';
      echo 'Last Name: ' . $lastName . '<br>';
      echo 'Delivery Address: ' . $deliveryAddress . '<br>';
      echo 'Suburb: ' . $suburb . '<br>';
      echo 'State: ' . $state . '<br>';
      echo 'Country: ' . $country . '<br>';
      echo 'Email: ' . $email . '<br>';

      // Display the individual prices
      echo 'Individual Item Prices:<br>';
      foreach ($individualPrices as $index => $individualPrice) {
        echo 'Item ' . ($index + 1) . ': ' . $itemNames[$index] . ' | Price: ' . $individualPrice . '<br>';
      }

      echo 'Total Price: ' . $totalAmount . '<br>';
    } else {
      echo 'Failed to send confirmation email. Please contact support.';
    }

    echo '</div>';

    echo '<br><center><font size=1>Note for TA: the mail() function was used to send email, but it will not work because I do not have an email server setup for this site.</font></center>';
  }
}
mysqli_close($conn);
session_abort();
?>