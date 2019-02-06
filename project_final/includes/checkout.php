<?php
  session_start();
  session_destroy();

  /* Creates connection */
    include ('connect.php');
    include ('logout-button.php');

    // Select statement takes data from database
      $q = 'SELECT * FROM users';

      $result = $con->query($q); // OOP

  //include ("header.html");
  echo "Thank you for your purchase.";
  //echo $_SESSION['first_name']; echo " ";  echo $_SESSION['last_name'];
?>
