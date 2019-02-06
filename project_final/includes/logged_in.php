<?php

if(!empty($_SESSION["email"])) {
  ?>
  <a class="" style="width = 10px;"href="logout.php">
    <img src="../images/design/signout.png" alt="" height="20px" width="20px">
    Log Out
  </a>
  <?php
} else {
  header ("Location: main_header.html");
}

?>
