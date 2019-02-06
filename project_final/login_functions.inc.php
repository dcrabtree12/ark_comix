<?php

include ("includes/connect.php");
$con->select_db('../book_comic');

// This page defines two functions used by the login/logout process.
function redirect_user ($page = '../login.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	// Removes trailing slashes.
	$url = rtrim($url, '/\\');

	// Adds page
	$url .= '/' . $page;

	// Redirects the user.
	header("Location: $url");
	exit(); // Quits script.

} // Ends redirect_user() function.
