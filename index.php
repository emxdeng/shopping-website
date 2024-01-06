<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<?php require_once 'head.php' ?>

<body>
    <!--Javascript Link-->
    <script src="script.js" defer></script>

  <!--header starts-->
  <?php require_once 'header.php'; ?>
  <!--header ends-->

  <!--grocery grid begins-->
  <?php include('item_grid.php'); ?>
  <!--grocery grid ends-->

  <!--Shopping cart section-->
  <?php include('shopping_cart_section.php'); ?>



</body>


</html>