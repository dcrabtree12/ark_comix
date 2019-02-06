<?php
/*
 	Name: Dayla Crabtree
 	Class: Web Database Development
 	Purpose: Create Login for website to show user data based on login information.
*/

	include ('main_header.html');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      /* Variables */
        $email = $_POST['email'];
  		  $password = $_POST['password'];

        try {
  			     if (empty($email) ||
  				       empty($password))
  				   throw new Exception('Enter all fields.');

  			/* Takes user data from book_comic database */
        include ('includes/connect.php'); // Includes file connection.
  			     $q = "SELECT * FROM users
  				       WHERE email = '$email'";
  			     $result = $con->query($q);

  			     if (!$result) // If login fails.
  				   throw new Exception("Login failed. Please try again.");

  			        $row = $result->fetch_assoc();
  			        $id = $row['user_id'];
                $firstName = $row['first_name'];
                $lastName = $row['last_name'];
                $book = $row['book'];
                $comic = $row['comic'];
  			        $email = $row['email'];
                $hash = $row['email_password'];
  			        //$isAdmin = $row['is_admin'];

          /* Check password */
  			     if (password_verify($password, $hash)) {
  				         // success! start session and redirect to main page
                   session_destroy();
                      session_start();
                      $_SESSION['user_id'] = $id;
                      $_SESSION['first_name'] = $firstName;
                      $_SESSION['last_name'] = $lastName;
                      $_SESSION['book'] = $book;
                      $_SESSION['comic'] = $comic;
                      $_SESSION['email'] = $email;
                      $_SESSION['email_password'] = $password;
                      $_SESSION['edit'] = false;
                      //$_SESSION['isAdmin'] = $isAdmin;

                   header("Location: includes/login_connect.php");
            } else {
                throw new Exception("Login failed. Please try again.");
            }
      } // End of try statement.
      catch (Exception $ex) {
  			echo '<div class="error">' . $ex->getMessage() . '</div>';
  		}
  	} // End of REQUEST_METHOD

?>

  <form action="login.php" method="post" class="layout">
    <h3 class="noindent"> Log In </h3>

      <input type="text" class="sign" name="email" id="email"
       required="required" placeholder="Email Address"size="20" maxlength="60"/>

      <input type="password" class="sign" name="password" id="password"
       required="required" placeholder="Password"size="20" maxlength="60"/>

    <br><br>
    <button>Log In</button>
</form>

<?php include ('includes/footer.php'); ?>
