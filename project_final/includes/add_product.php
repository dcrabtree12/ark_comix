<?php

include ('header_loggedin.html');
include ('logout-button.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


			 /* Variables */
			 $price = $_POST['price'];
			 $productName = $_POST['productName'];
			 $description = $_POST['description'];

				require 'connect.php';
				//$images = $con->query('select * from products');

				$q = "INSERT INTO products (productName, description, price, image_id)
				VALUES ('$productName', '$description', '$price', '$img')";

				echo $_POST['productName'];
				echo $_POST['price'];
				echo $_POST['description'];

			 // Insert into database
				$result = $con->query($q); // OOP

				if ($con->query($q)) {
					echo '<a href="../products.php">Okay</a><br/>';
				}
				if (isset($_POST['price']) && is_numeric($_POST['price'])) {
		    }
}

//image varchar(255) NOT NULL,
	?>

	<form action="" method="post" class="layout" enctype="multipart/form-data">
		<h1>Add Product to store </h1>
	<label>Product Name </label>
	<input type="text" name="productName">
	<br><br>
	<label>Price </label>
	<input type="text" name="price">
	<br><br>
	<label>Description </label>
	<textarea name="description" rows="10" cols="30"></textarea>
	<br><br>
	<label>Image </label>
	<input type="file" name="upload">
	<br><br>
	<button type="submit">Upload Image</button>
</form>


 <?php
 require_once 'connect.php';
 //$images = $con->query('select * from products');
 $images = $con->query('select * from images');
 ?>
<?php while ($img = $images->fetch_object()): ?>
<h5><?=$img->filename?></h5>
<img src="get-image.php?id=<?=$img->image_id?>" title="<?=$img->filename?>" height="150" width="150">
<?php endwhile;
?>

</body>

<?php

require_once '../mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//$productName = $_POST['productName'];
	//$price = $_POST['price'];
	//$description = $_POST['description'];
	handleUpload($con);
}

function handleUpload($con) {

	if (!isset($_FILES['upload'])) {
		return;
	}

	$upload = $_FILES['upload'];
	$tmpName = $upload['tmp_name'];
	$fileName = $upload['name'];
	$fileType = $upload['type'];
	$fileSize = $upload['size'];

	if (file_exists($tmpName)) {
		$stream = fopen($tmpName, 'r'); // opens image file stream
		$data = fread($stream, $fileSize); // read byte data
		fclose($stream); // close image file stream

		$stmt = $con->prepare('insert into images (filename,
			image_type, image_data) values(?, ?, ?)');
		$stmt->bind_param('sss', $fileName, $fileType, $data);

		if ($stmt->execute()) {
			$stmt->insert_id;
			//echo $_SESSION['image_data'];
			header('Location: add_product.php');
		} else {
			echo $stmt->error;
		}
	}
}
