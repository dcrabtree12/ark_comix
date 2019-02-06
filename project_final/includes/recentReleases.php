<?php
  include ('header.html');
  include ('logout-button.php');

  /* Creates connection */
    $connection = new mysqli(
      'localhost', 'root', '', 'book_comic');

  // Select statement takes data from database
    $q = 'select * FROM membership';

    $result = $connection->query($q); // OOP
?>

  <h4 class="options" style="padding-right: 250px"> Recent Releases </h4>

  <div id="releases">
    <a href="recentReleases.php">Recent Releases</a>
    <a href="sales.php">Upcoming Sales</a>
  </div>

<?php // Looping to show columns from database
  if ($result) {
    // var_dump($result); // like multidimensional array
    foreach($result as $row) {
      echo "<p>{$row ['recentRelease']}</p>";
      echo "<p>Discount: {$row ['discount']}</p>";
    }
    //$result->data_seek(0);
  }
?>

  <br><br><br><br><br><br><br>

  <div id="additional">
    <p> Random additional information<p>
  </div>

  <br><br>

<?php include ('footer.php'); ?>
