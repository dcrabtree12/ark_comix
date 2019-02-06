
<?php

session_start();
$items = $_SESSION['cart'];
$cart = explode(",", $items);

if(isset($_GET['delete']) & !empty($_GET['delete'])){
	$delitem = $_GET['delete'];
	unset($cart[$delitem]);
	$itemids = implode(",", $cart);
	$_SESSION['cart'] = $itemids;
}

header('location: includes/cart.php');

require "connect.php";

$q = 'SELECT * FROM products';
$result = $con->query($q);

$proId = $_GET['product_id'];
$q = "DELETE FROM products WHERE product_id = $proId ";

if ($result) {
    header('Location: cart.php');
} else {
    echo $con->error;
}
?>
