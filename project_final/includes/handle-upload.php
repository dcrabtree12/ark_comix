<?php

session_start();
include ('header.html');
include ('logout-button.php');
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

		$stmt = $con->prepare('insert into images (product_id, filename,
			image_type, image_data) values(?, ?, ?)');
		$stmt->bind_param('ssss', $productName, $fileName, $fileType, $data);

		if ($stmt->execute()) {
			//echo $_SESSION['image_data'];
			header('Location: add_product.php');
		} else {
			echo $stmt->error;
		}
	}
}
