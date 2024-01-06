<?php
// Connect to the database and start the session
require_once 'db_connect.php';
session_start();

// Retrieve the item ID from the URL
if (isset($_GET['id'])) {
  $item_id = $_GET['id'];
} else {
  header("Location: index.php");
  exit();
}

// Query the database for the item information
$query = "SELECT * FROM items WHERE id = $item_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
  header("Location: index.php");
  exit();
}

// Retrieve the item information from the database
$item = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php' ?>

<body>

<!--Javascript Link-->
<script src="script.js" defer></script>

  <?php require_once 'header.php' ?>

    <!--Shopping cart section-->
    <?php include('shopping_cart_section.php'); ?>


  <main>
    <section class="product-details">
      <div class="img-details-page">
        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="details-image-container">
      </div>
      <div class="product-description">
        <h1><?php echo $item['name']; ?></h1>
        <br>
        <p><?php
            echo 'Category: ';
            if ($item['category'] == 'Frozen Food' || $item['category'] == 'Fresh Food' || $item['category'] == 'Beverages') {
              echo 'Food & Drink<br>';
            } else if ($item['category'] == 'Health' || $item['category'] == 'Beauty' || $item['category'] == 'Personal Care') {
              echo 'Health & Beauty<br>';
            } else if ($item['category'] == 'Living Room' || $item['category'] == 'Bathroom' || $item['category'] == 'Kitchen') {
              echo 'Furniture<br>';
            } else if ($item['category'] == 'Tops' || $item['category'] == 'Bottoms' || $item['category'] == 'Outerwear') {
              echo 'Clothing<br>';
            } else {
              echo 'Pets<br>';
            }
            echo 'Subcategory: ' . $item['category'];
            ?></p>
        <br>
        <p class="price">$<?php echo $item['price']; ?></p>
        <p><?php echo $item['details']; ?></p>
        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
        <label for="quantity">Quantity Remaining:</label>
        <?php echo ' ' . $item['stock']; ?>

        <br><br><br>
        <?php
        $item_query = "SELECT * FROM cart_items WHERE item_id =" . $item['id'];

        $result_button = mysqli_query($conn, $item_query);
        $num_rows = mysqli_num_rows($result_button);

        if ($item['id'] <= 0) return;

        if ($num_rows > 0) {
          echo '<button class="add-to-cart-btn disabled">Added to Cart</button>';
        } else {
          echo '<button class="add-to-cart-btn" id="add-to-cart-' . $item['id'] . '" 
      data-item-id="' . $item['id'] . '" ' .
            'data-item-price="' . $item['price'] .
            '" data-item-stock="' . $item['stock'] .
            '" onclick="addToCart(' . $item['id'] . ')">Add to Cart</button>';
        }
        mysqli_close($conn);
        ?>

        <!-- <button type="submit" class="add-to-cart-btn">Add to Cart</button> -->
      </div>
    </section>
  </main>

</body>

</html>