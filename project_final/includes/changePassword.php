<?php
/*
  Name: Dayla Crabtree
  Class: Web Database Development
  Purpose: Allows current user to change their password.
*/
  include ('header.html'); // Header and Navigation
  include ('logout-button.php');

  session_start(); // Allows $_SESSION to be recognized.

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        /* Variables */
          $email = $_SESSION['email'];
          $currentPass = $_POST['currentPass'];
		      $newPassword = $_POST['newPassword'];
		      $confirmPass = $_POST['confirmPass'];

          include ('connect.php'); // Includes file connection.
            $q = "SELECT * FROM users WHERE email = '$email'";

            $result = $con->query($q);

            if ($result) {
                $row = $result->fetch_assoc();
                $id = $row['user_id'];
                $email = $row['email'];
                $hash = $row['email_password'];
            }

          /* If the current password matches password in database. */
            if (password_verify($currentPass, $hash)) {
                echo "You entered your current password.";

                /* If new password = the confirm password. */
                if ($newPassword === $confirmPass) {

                /* Encrypt password */
                    $newPassword = $con->real_escape_string(
                    password_hash($newPassword, PASSWORD_BCRYPT));

                     $con->query("UPDATE users
                        SET email_password = '$newPassword'
                        WHERE email = '$email'");

                    header("Location: login_connect.php"); // Takes user back to their account page.

                }  else { // If passwords do not match.
                  echo "New password and confirm password must be the same!";
                } // End of else.

            } else { // If the current password doesn't match database password.
              echo "That is not the current password.";
            }
} // End of POST
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="layout">
  <h3> Change password </h3>

  <label> Current Password </label>

    <input type="password" name="currentPass" class="sign"/><br/><br/>
    <span id="currentPassword"  class="required"></span>

  <label> New Password </label>

    <input type="password" name="newPassword" class="sign"/><br/><br/>
    <span id="newPassword" class="required"></span>

  <label> Confirm Password </label>

    <input type="password" name="confirmPass" class="sign"/><br/><br/>
    <span id="confirmPass" class="required"></span>

    <input type="submit" name="submit" value="Submit" class="">

<?php include ('footer.php'); ?>
