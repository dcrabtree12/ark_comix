<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php

/* Variables */
$nameErr = $emailErr = $passwordErr = $preferenceErr = $bookErr = $comicErr = $notificationsErr = "";
$firstname = $lastname = $email = $enteremail = $password = $confirmPassword = $preference = $book = $comic = $notifications = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

/* Conditions */

  // First and last name
  if (!empty($firstname) && !empty($lastname)) { // If they are not empty
			echo "<p>Thank you <b>$firstname $lastname</b> for creating your account.</p>";
	} else if (empty($firstname) && empty($lastname) ) { // If they are empty
      $nameErr = "Name is required";
  } else {
      $firstname = test_input($_POST["fname"]);
      $lastname = test_input($_POST["lname"]);

      // If name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
        $nameErr = "Only letters and white space allowed";
      }
  }

  // Email Address
  if (empty($_POST["email"]) && empty($_POST["enteremail"])) { // If email is empty
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    $enteremail = test_input($_POST["enteremail"]);

    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }

    if (!filter_var($enteremail, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  // If password is not empty
			if (!empty($password) && !empty($confirmPassword)) {
				if ($_POST['password'] != $_POST['confirm']) {
						$passwordErr = "Make sure they match";
				} else {
						$passwordErr = trim($_POST['password']);
				}
			}

  // If preference is not empty
			if(!empty($_POST['preference'])) {
				  echo "<p>Thank you for selecting ". $_POST['preference'] ." preference(s): </p>";
			} else {
					echo "<p>You did not select a <b>preference</b>.</p>";
			}

	// Book genres output
			if(!empty($_POST['book'])) {

				$book_count = count($_POST['book']); // Counts number of checked checkboxes.
				echo "<p>Thank you for selecting <b>". $book_count ."</b> book genres(s): </p>";

	    // Loops to store/display values of checked checkbox(s).
				foreach($_POST['book'] as $selected) {
					echo "<b> ". $selected ." </b>";
				}
			}

	// Comic genres output
			if (!empty($comic)) {
				echo "<p>You comic genre(s) are ". $_POST['comic'] .".</p>";
			} else {
					echo "<p>You did not select any <b>comic</b> genre.</p>";
			}

	// If notifications is yes
			if ($_POST['notifications'] == 'yes') {
				echo "<p><i><b>Thank you for deciding to recieve notifications based on your selection.</b></i></p>";
			} else if ($_POST['notifications'] == 'no'){
				echo "<p><i><b>You will not be recieving notifications based on your selection.</b></i></p>";
			}
} /* End of post */

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
