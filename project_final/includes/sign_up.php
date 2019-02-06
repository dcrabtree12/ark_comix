<?php
/*
 	Name: Dayla Crabtree
 	Class: Web Database Development
 	Purpose: Create Account Sign-up for website requesting for a first name,
 					last name, email address, password, preference, genres, and notifications.
*/

// var_dump($_POST); // will show everything on the screen
require ('get_books.php');
require ('get_comics.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$errors = array(); // Errors array

	/* Validation */
		if (isset($_POST['fname'], $_POST['lname']) &&
			is_string($_POST['fname']) && is_string($_POST['fname']) ) {

	/* Variables */
				$firstname = $_POST['fname'];
				$lastname = $_POST['lname'];
				$email = $_POST['email'];
				$emailCon = $_POST['enteremail'];
				$password = $_POST['password'];
				$confirmPassword = $_POST['confirm'];
				$book =  $_POST['book'];
				$comic = $_POST['comic'];

	/* Exceptions */

		try {
			if (
				empty($firstname) ||
				empty($lastname) ||
				empty($email) ||
				empty($emailCon) ||
				empty($password) ||
				empty($confirmPassword) ||
				empty($book) || // Book section can be empty.
				empty($comic))
				throw new Exception('Enter all
					fields.');

			if ($password != $confirmPassword)
				throw new Exception('Passwords must match.');

			if ($email != $emailCon)
				throw new Exception('Emails must match.');

			// MySQL file connection.
				include ('includes/connect.php');
				$result = $con->query(
					"SELECT * FROM users
					WHERE email = '$email'");

			if ($result->num_rows > 0) {
				throw new Exception('A user has already been created with this email.  Please try another.');
			}

			// Encrypt password
			$password = $con->real_escape_string(
				password_hash($password, PASSWORD_BCRYPT));

			// Insert into database
			$q = "INSERT INTO users (book_id, comic_id, first_name, last_name, email, email_password)
			VALUES ('$book', '$comic', '$firstname', '$lastname', '$email', '$password')";

			if ($con->query($q)) {
				/* Register the user in the database...*/
					echo "<p>Thank you <b>$firstname $lastname</b> for creating your account.</p>";
					echo "<p>You should recieve an email from us at <i><b> $email </b></i></p>";

					// Book genre output
							if(!empty($_POST['book']) ) {
								echo "<p>Thank you for selecting genre(s).</p>";
							}

							if($_POST['book'] == 1) {
								echo "You have no book preference.";
							}

							if($_POST['comic'] == 1) {
							 echo "You have no comic preference.";
						  }

					echo "<p>Please log in your new account.";
					echo '<a href="login.php">Okay</a><br/>';

			} else {
					echo 'Problem saving to database: ' . $con->error;
			}
		}
			catch (Exception $ex) {
				echo '<div class="error">' . $ex->getMessage() . '</div>';
			}
		}
}

?>
