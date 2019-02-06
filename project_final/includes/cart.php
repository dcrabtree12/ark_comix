<?php
/*
	Name: Dayla Crabtree
	Class: Web Database Development
	Purpose: Create Account page that shows data from database.
*/

//session_start();
include ('header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (isset($_SESSION['cart'][$pid])) {

		$_SESSION['cart'][$pid]['quantity']++; // Add another.
	}

	if (isset($_POST["quantity"])) { // Add Button

		if(isset($_SESSION["cart"])) { // Cart

				$item_array_id = array_column($_SESSION["cart"], "product_id");

				if(!in_array($_GET["id"], $item_array_id)) {

						$count = count($_SESSION["cart"]);

						$item_array = array(
							'product_id' => $_GET["id"],
							'productName' => $_POST["hidden_name"],
							'price' => $_POST["hidden_price"],
							'quantity' => $_POST["quantity"]
						);

						$_SESSION["cart"][$count] = $item_array;
						//echo '<script>alert("Product has been added to cart.")</script>';
				  	echo '<script>window.location="../products.php"</script>';
		   	} else { // End of array statement
						echo '<script>alert("Products already added to cart")</script>';
						echo '<script>window.location="cart.php"</script>';
				}

	  } else { // End of cart session

				$item_array = array(
					'product_id' => $_GET["id"],
					'productName' => $_POST["hidden_name"],
					'price' => $_POST["hidden_price"],
					'quantity' => $_POST["quantity"]
				);

				$_SESSION["cart"][0] = $item_array;
		}
} // End of quantity/add statement


		if(isset($_GET["action"])) {

			if($_GET["action"] == "delete") {

				foreach ($_SESSION["cart"] as $keys => $values) {
						if ($values["product_id"] == $_GET["id"]) {
							unset($_SESSION["cart"]);
							echo '<script>alert("Product has been removed")</script>';
							echo '<script>window.location="cart.php"</script>';
						} // End of if statment
				} // End of for each

		  } // End of $_GET["action"] == "delete"

	  } // End of isset($_GET["action"])

		} // End of SUBMITTED IF.

 ?>
  	<div style="clear:both"></div>
    	<h2>My Cart</h2>

			<div class="">
    		<table class="">
    			<tr>
    				<th width="20%">Product Name</th>
    				<th width="10%">Price</th>
    				<th width="20%">Quantity</th>
    				<th width="15%">Order Total</th>
    				<th width="5%">Action</th>
    			</tr>
<?php
	if(!empty($_SESSION["cart"])) {
		$total = 0;
			foreach($_SESSION["cart"] as $keys => $values) {
?>
        <tr>
          <th><?php echo $values["productName"]; ?></th>
          <th>$<?php echo number_format($values["price"], 2); ?></td>
						<?php
						if ($values["quantity"] == 0) {
							unset ($_SESSION['cart']['quantity']);
						}
						 ?>


						<td align=""><input type="text" size="3" name="<?php echo $values["quantity"]?>" value="<?php echo $values["quantity"]; ?>" /></td>
					<th><?php echo $values["quantity"]; ?></td>
          <th>$<?php echo number_format($values["quantity"] * $values["price"], 2); ?></th>

					<th><a href='../delCart.php?action=delete&id=<?php echo $values["product_id"]; ?>'> <span class="">Delete</span></a>
        </tr>

<?php
$subtotal = 1.50;
$total = $total + ($values["quantity"] * $values["price"]) + $subtotal; }?>
				<tr>
					<th> Tax </th>
					<th >$ <?php echo number_format($subtotal, 2); ?></th>
				</tr>
        <tr>
        	<th >Total</th>
        	<th >$ <?php echo number_format($total, 2); ?></th>
        </tr>
<?php } ?>
      </table>
    </div>
  </div>


    <a href="../products.php">Continue Shopping</a>
		<a href="checkout.php">Checkout</a>
 </body>
</html>
