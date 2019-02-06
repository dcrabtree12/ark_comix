<?php

require_once '../mysql.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (isset($id)) {
	$stmt = $con->prepare('select product_id, filename, image_type, image_data
		from images where image_id = ?');
	$stmt->bind_param('i', $id);

	if ($stmt->execute()) {
		$result = $stmt->get_result(); // mysqli_result
		$img = $result->fetch_object(); // image row

		header('Content-type: ' . $img->image_type);
		echo $img->image_data;
	}
}
