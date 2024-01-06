<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php' ?>

<body>

  <?php require_once 'header.php' ?>

  <div class="container">
    <div class="left">
      <h1>Order Placement</h1>
      <br>
      <form action="place_order_process.php" method="POST">
        <table>
          <tr>
            <td><label for="first-name">First Name:</label><span class="required">*</span></td>
            <td><input type="text" id="first-name" name="first-name" required></td>
          </tr>
          <tr>
            <td><label for="last-name">Last Name:</label><span class="required">*</span></td>
            <td><input type="text" id="last-name" name="last-name" required></td>
          </tr>
          <tr>
            <td><label for="delivery-address">Delivery Address:</label><span class="required">*</span></td>
            <td><input type="text" id="delivery-address" name="delivery-address" required></td>
          </tr>
          <tr>
            <td><label for="suburb">Suburb:</label></td>
            <td><input type="text" id="suburb" name="suburb"></td>
          </tr>
          <tr>
            <td><label for="state">State:</label></td>
            <td><input type="text" id="state" name="state"></td>
          </tr>
          <tr>
            <td><label for="country">Country:</label></td>
            <td><input type="text" id="country" name="country"></td>
          </tr>
          <tr>
            <td><label for="email">Email Address:</label><span class="required">*</span></td>
            <td><input type="email" id="email" name="email" required></td>
          </tr>
          <tr>
            <td colspan="2"><input type="submit" id="place-order" onclick="clearCartProcess()" value="Place Order"></td>
          </tr>
        </table>
      </form>
    </div>
    <div class="right">
      <h2>Order Summary</h2>
      <br><br>
      <iframe id="shopping-cart-summary" src="display_cart_summary.php"></iframe>
    </div>
  </div>

</body>

</html>


<script>
  function clearCartProcess() {
  var tableBody = document.getElementById("cart-table-body");
  var rows = tableBody.getElementsByTagName("tr");

  // Iterate through each row and remove the item
  for (var i = rows.length - 1; i >= 0; i--) {
    var itemId = rows[i].getAttribute("data-item-id");
    removeItem(itemId, i === 0); // Pass a flag indicating if it's the last item to remove
  }

}
</script>