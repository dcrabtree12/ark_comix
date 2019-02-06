<?php
session_start();
session_destroy();

unset($_SESSION["login_connect.php"]);
//header('Location: ../index.php');
//$_SESSION = array();

// If no cookie is present, redirect user.
	if (!isset($_COOKIE['user_id'])) {
		// Need the functions:
		include ('../login_functions.inc.php');

	} else { // Cancels the session.
		setcookie ('user_id', '', time()-3600, '/', '', 0, 0);
		setcookie ('first_name', '', time()-3600, '/', '', 0, 0);

		$_SESSION = array(); // Clears variables.
		session_destroy(); // Destroys session.
		setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroys cookie.
	}
	header('Location: ../index.php');

	include ('footer.php');
?>
