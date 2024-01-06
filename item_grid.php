<?php

session_start();

include 'db_connect.php';

$SESSION['$category'] = isset($_GET['category']) ? $_GET['category'] : '';

if (isset($_POST['search'])) {
  $SESSION['$search_query'] = $_POST['search'];
  $SESSION['$query_string'] = "SELECT * FROM items WHERE name LIKE '%" . $SESSION['$search_query'] . "%'";
} else if ($SESSION['$category']) {
  $SESSION['$query_string']  = "SELECT * FROM items WHERE category LIKE '" . $SESSION['$category'] . "'";
} else {
  $SESSION['$query_string']  = "SELECT * FROM items";
}

// Add a price filter if a price range is specified
if (isset($_GET['price'])) {
  $price_range = explode('-', $_GET['price']);
  $min_price = $price_range[0];
  $max_price = isset($price_range[1]) ? $price_range[1] : PHP_INT_MAX;

  if ($max_price == "30+") {
    $max_price = PHP_INT_MAX;
  }

  if ($SESSION['$category']) {
    $SESSION['$query_string'] .= " AND price BETWEEN $min_price AND $max_price";
  } else {
    $SESSION['$query_string'] .= " WHERE price BETWEEN $min_price AND $max_price";
  }
}

$SESSION['$query_string'] .= " ORDER BY name";
$SESSION['$current_url'] = basename($_SERVER['PHP_SELF']) . '?' . $_SERVER['QUERY_STRING'];
$SESSION['$result'] = mysqli_query($conn, $SESSION['$query_string']);
$SESSION['$num_rows'] = mysqli_num_rows($SESSION['$result']);

?>;

<div class="shopping-title">
  <h1>
    <?php
    if ($SESSION['$category']) {
      echo $SESSION['$category'];
    } else if ($SESSION['$search_query']) {
      echo 'Search results for: "' . $SESSION['$search_query'] . '"';
    } else {
      echo 'All Items';
    }
    echo ' (' . $SESSION['$num_rows'] . ')';
    ?>
  </h1>
  <br>
  <p>
  <div class="price-filters">
    <h3>Price Filters</h3>
    <br>
    <a href="<?php echo $SESSION['$current_url'] . '&price=0-14.99'; ?>">0-14.99</a>
    <a href="<?php echo $SESSION['$current_url'] . '&price=15-29.99'; ?>">15-29.99</a>
    <a href="<?php echo $SESSION['$current_url'] . '&price=30+'; ?>">30+</a>
  </div>
  </p>
</div>

<?php
if ($SESSION['$num_rows'] > 0) {
  echo '<div class="shopping-grid">';
  while ($item = mysqli_fetch_assoc($SESSION['$result'])) {
    echo '<div class="item';
    if ($item['stock'] == 0) {
      echo ' out-of-stock';
    }
    echo '">';
    echo '<div class="image-container">';
    // Wrap the image element in an anchor tag
    echo '<a href="item_details.php?id=' . $item['id'] . '"><img src="' . $item['image'] . '" alt="' . $item['name'] . '"></a>';
    echo '</div><br>';
    echo '<h3>' . $item['name'] . '</h3>';
    echo '<p>' . $item['price'] . '</p>';
    echo '<p class="item-description">';
    if ($item['stock'] == 0) {
      echo 'Out of Stock';
    } else {
      echo $item['details'];
    }
    echo '</p>';
    
    $item_query = "SELECT * FROM cart_items WHERE item_id =" . $item['id'];

    $result_button = mysqli_query($conn, $item_query);
    $num_rows = mysqli_num_rows($result_button);

    if ($num_rows>0){
      echo '<button class="add-to-cart-btn disabled">Added to Cart</button>';

    } else {
      echo '<button class="add-to-cart-btn" id="add-to-cart-' . $item['id'] . '" 
      data-item-id="' . $item['id'] . '" ' .
        'data-item-price="' . $item['price'] .
        '" data-item-stock="' . $item['stock'] .
        '" onclick="addToCart(' . $item['id'] . ')">Add to Cart</button>';
    }

    echo '</div>';
  }
  echo '</div>';
}

session_abort();
mysqli_close($conn);

?>