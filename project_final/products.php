<?php
/*
  Name: Dayla Crabtree
  Class: Web Database Development
  Purpose: View Products in store and add to cart.
*/

session_start();
	include ('main_header.html');
  include ('includes/logout-button.php');
	include ('includes/connect.php');

/* Select statement takes product data from database */
	$q = 'SELECT * FROM products';

	$result = $con->query($q); // OOP
?>

<h5 class="heading">Other Stores</h5>
<h5 class="heading middleHeading">Online Store</h5>

	<a href="http://marvel.com/">Marvel Comics</a><br>
	<a href="http://www.dccomics.com/">DC Comics</a><br>
	<a href="http://www.barnesandnoble.com/">Barnes & Noble</a><br>
	<a href="http://www.ebay.com/">Ebay</a>

	<div id ="storeItems">

		<?php $images = $con->query('select * from images');
							while ($img = $images->fetch_object()):
		?>
			<img src="includes/get-image.php?id=<?=$img->image_id?>" title="<?=$img->filename?>" height="150" width="150">
			<?=$img->product_id?>
		<?php
			 endwhile;
		?>

<?php
	if (mysqli_num_rows($result) > 0) {

		while($row = mysqli_fetch_array($result)) {
?>
	 <div class="floating-box">
		<form method="post" action="includes/cart.php?action=add&id=<?php echo $row["product_id"]; ?>" style ="">

			<img src="<?php echo $row["image"]; ?>" class="img-responsive" alt = "<?php echo $row["product_id"]; ?> height= "150px;" width = "150px;"">
			<span><?php echo $row["productName"]; ?></span></br>
			<h5 class="text-danger">$ <?php echo $row["price"]; ?></h5>
			<?php echo $row["description"]; ?><br/>

			<select  name="quantity" class="" value="1">
				<?php
					for($i = 1; $i < 16; $i++) {
							// Amount in select box for number of products.
				 			echo '<option value='. $i .'>'. $i .'</option>';
					}
				?>
			</select>

			<input type="hidden" name="hidden_id" value="<?php echo $row["product_id"]; ?>">
			<input type="hidden" name="hidden_name" value="<?php echo $row["productName"]; ?>">
			<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
			<button type="submit" name="submit">Add</button><br/><br/>

		</form>
	</div>
</div>
<?php
		}
}

include ('includes/footer.php');
?>
