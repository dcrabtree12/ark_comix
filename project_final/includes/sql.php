<?php

// Create connection for MySQL
$conn = new mysqli($firstname, $lastname, $email, $password, $preference, $book,
$comicIndex, $notifications)
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users (first_name, last_name, email)
VALUES ('', '', '')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
