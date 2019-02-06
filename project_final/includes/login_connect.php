<?php
/*
  Name: Dayla Crabtree
  Class: Web Database Development
  Purpose: Create Account page that shows data from database.
*/

session_start();
/* Creates connection */
  include ('connect.php');

  // Select statement takes data from database
    $q = 'SELECT * FROM users';
    //$p = 'SELECT * FROM users u join books b on b.book_id = u.book_id';

    $result = $con->query($q); // OOP

      include ('header.html');
      include ('logout-button.php');

?>
  <h3> My Account </h3>


    <p><b>Name: </b><?php echo $_SESSION['first_name']; echo " ";  echo $_SESSION['last_name'];?></p>
    <b>ID: </b><?php echo $_SESSION['user_id'];?>
    <p><b>Email: </b><?php echo $_SESSION['email']; ?></p>

    <p><a href="logout.php">Logout</a></p>
    <p><a href="changePassword.php">Change Password</a></p>
    <p><a href="add_product.php">Add Product</a></p>

  <?php //include ("cart.php");?>

  <h3> Notifications </h3>
  <?php
  include ('get_books.php');
  include ('get_comics.php');
  /*
  echo $_SESSION['book'];
  echo $_SESSION['book_id'];
  echo $_SESSION['comic_id'];
  echo $_SESSION['book_categories'];
  echo $_SESSION['comic_categories'];
  echo $_SESSION['book_message'];
  echo $_SESSION['comic_message'];
  */
  ?>

  <h3> All users </h3>
  <?php
  /* Looping to show columns from database */
    if ($result) {
      // var_dump($result); // like multidimensional array
      echo '<ul>';
      foreach($result as $row) {
        // Makes column for first name, last name, and email address
        echo "<br/>";
        echo "<tr>{$row ['first_name']} {$row ['last_name']}</tr>";
        echo "<tr> || {$row ['email']}</tr>";
      }
      echo '</ul>';
      $result->data_seek(0);
    }
    ?>
<?php include ('footer.php');?>
