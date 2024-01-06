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

<form>
  <table id='cart-table-body'>
    <thead>
      <tr>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
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

        // Update the total amount
        $totalAmount += $itemPrice * $quantity;

        // Generate the table rows
        echo "<tr data-item-id=" . $itemId . ">";
        echo "<td>$itemName</td>";
        echo "<td><input type='number' name='quantity' id='quantity-" . $itemId . "' value='" . $quantity . "' min='1' max='20' onchange='updateCart(" . $itemId . ", this.value)'></td>";
        echo "<td>$itemPrice</td>";
        echo "<td><button onclick='removeItem($itemId)'>Remove</button></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</form>

<?php
// Display the total amount
echo "<div class='cart-total'>";
echo "<span>Total:</span>";
echo "<span class='total-amount' id='total-amount'>$" . number_format($totalAmount, 2) . "</span>";
echo "</div>";


if ($num_rows > 0) {
  echo "<button class='checkout-btn' id='checkout-btn'>Checkout</button>";
  echo "<button onclick='clearCart()'>Clear Cart</button>";
} else {
  echo "<p id='cart-empty-msg'>Your cart is empty.</p>";
}


?>

<script>
  // Add a click event listener to Checkout Button
  var checkoutBtn = document.getElementById('checkout-btn');

  checkoutBtn.addEventListener('click', function() {
    // Redirect to the PHP page
    window.parent.location.href = 'place_order.php';
  });

  //Remove item from cart
  function removeItem(itemId, isLastItem) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      console.log(response.success);
      if (response.success) {
        // Remove the table row from the HTML
        var row = document.getElementById("row-" + itemId);
        if (row) {
          row.parentNode.removeChild(row);
        }

        // Recalculate the total amount
        var totalAmount = parseFloat(document.getElementById("total-amount").innerText.replace("$", ""));
        totalAmount -= response.itemTotalPrice;

        // Update the total amount in the HTML
        document.getElementById("total-amount").innerText = "$" + totalAmount.toFixed(2);

        // Check if the cart is empty and perform necessary actions
        var tableBody = document.getElementById("cart-table-body");
        if (tableBody.rows.length === 0) {
          document.getElementById("checkout-btn").style.display = "none";
          document.getElementById("cart-empty-msg").style.display = "block";
        } else if (isLastItem) {
          // It's the last item, but the cart is not empty
          // Perform any required actions for the last item removal
        }
      } else {
        console.log(response.error);
      }
    }
  };
  xmlhttp.open("GET", "remove_item.php?item_id=" + itemId, true);
  xmlhttp.send();
}


  // Function to update the cart totals and send the updated information to the server
  function updateCart(itemId, quantity) {
    // Send a request to the server to update the cart totals and the database
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response.success) {
          // Update the total amount in the HTML
          var totalAmount = parseFloat(response.totalAmount);
          document.getElementById("total-amount").innerText = "$" + totalAmount.toFixed(2);
        } else {
          console.log(response.error);
        }
      }
    };
    xmlhttp.open("GET", "update_cart.php?itemId=" + itemId + "&quantity=" + quantity, true);
    xmlhttp.send();
  }

  function clearCart() {
  var tableBody = document.getElementById("cart-table-body");
  var rows = tableBody.getElementsByTagName("tr");

  // Iterate through each row and remove the item
  for (var i = rows.length - 1; i >= 0; i--) {
    var itemId = rows[i].getAttribute("data-item-id");
    removeItem(itemId, i === 0); // Pass a flag indicating if it's the last item to remove
  }

  alert("Close and reopen cart to see updates. Please wait a moment for updates to load afterward. Refresh page to reload add to cart buttons.");
}


</script>