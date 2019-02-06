<?php
  /* Contains the database access information
     It also establishes a connection to MySQL
     Selects the database, and sets the encoding
  */

/* Database Connection */
  $con = new mysqli(
    'localhost', 'root', '', 'book_comic');

// Check connection
  if ($con->connect_error) {
      die("<br/>Connection failed: " . $con->connect_error);
  } else {
      //echo "<br/>Connected successfully<br/>";
  }

   $con->select_db('book_comic');

  // Set database access information as constants
    //DEFINE ('DB_USER', 'username');
    //DEFINE ('DB_PASSWORD', 'root');
    //DEFINE ('DB_HOST', 'localhost');
    //DEFINE ('DB_NAME', 'book_comic');

?>
