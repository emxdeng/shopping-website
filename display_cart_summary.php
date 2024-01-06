<?php
session_start();
require_once 'db_connect.php';

// Retrieve the data from the cart_items table, where cart and grocery items tables are joined
$query_string = "SELECT ci.item_id, ci.price, ci.qtyOrdered, i.name AS item_name, i.price AS item_price, (ci.qtyOrdered * i.price) AS total_price
      FROM cart_items ci
      INNER JOIN items i ON ci.item_id = i.id";
$result = mysqli_query($conn, $query_string);
$num_rows = mysqli_num_rows($result);

$totalAmount = 0; // Initialize total amount variable

mysqli_close($conn);
?>

<table id='cart-table-body'>
  <thead>
    <tr>
      <th>Item Name</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      // Access the columns of each row
      $itemId = $row['item_id'];
      $itemName = $row['item_name'];
      $quantity = $row['qtyOrdered'];
      $itemPrice = $row['item_price'];
      $totalPrice = $row['total_price'];

      // Update the total amount
      $totalAmount += $totalPrice;

      // Generate the table rows
      echo "<tr>";
      echo "<td>$itemName</td>";
      echo "<td><center>$quantity</center></td>";
      echo "<td>$itemPrice</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<?php
// Display the total amount
echo "<br><b>";
echo "<div class='cart-total'>";
echo "<span>Total:</span>";
echo "<span class='total-amount' id='total-amount'>$" . number_format($totalAmount, 2) . "</span>";
echo "</b></div>";

if ($num_rows === 0) {
  echo "<p id='cart-empty-msg'>Your cart is empty.</p>";
}
?>
