<?php
session_start();
require ('connect.php'); // Creates sql error
  $product_id = $_GET['id']; // id is correct
  $q = "delete from products
        where product_id = $product_id";
  $result = $con->query($q);

  if ($result) {
    header('Location: ./');
  } else {
    echo $con->error;
  }
?>
