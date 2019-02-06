<?php

	include ('main_header.html');
	include ('includes/logout-button.php');


//<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>


		<!-- Sign Up Form -->
		<form action="" method="post" class="layout">

			<!-- Title of Form -->
				<h3 class="noindent"> Create Account </h3>
				<?php include ('includes/sign_up.php'); ?>

			<!-- First and Last Name Inputs -->
				<span class="error">* </span>

					<input type="text" name="fname" class="sign" id="fname"
					 required="required" placeholder="First Name" size="20" maxlength="40" value ="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"/>

					<input type="text" name="lname" class="sign" id="lname"
					 required="required" placeholder="Last Name" size="20" maxlength="40" value ="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"/>

				<br><br>
			<!--  Email Inputs -->
				<span class="error">* </span>

					<input type="text" class="sign" name="email" id="email"
					 required="required" placeholder="Email Address"size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/>

					<input type="text" class="sign" name="enteremail" id="enteremail"
					 required="required" placeholder="Re-Enter Email Address"size="20" maxlength="60" value = "<?php if (isset($_POST['enteremail'])) echo $_POST['enteremail']; ?>"/>

				<br><br>
			<!--  Password Inputs -->
				<span class="error">* </span>

					<input type="password" class="sign" name="password" id="password"
					 required="required" placeholder="Password"size="20" maxlength="60"/>

					<input type="password" class="sign" name="confirm" id="confirm"
					 required="required" placeholder="Confirm Password" size="20" maxlength="60"/>

				<br><br>

				<label><span class="error">* </span>Select Book Genre:</label>
				<select name="book">
						<option></option>
						<?php
							// Connection to database
							$book = $con->query(
								'select * from books');

							if ($book) {
								while ($row = $book->fetch_object()) {
									$bookId = $row->book_id;
									$selected = isset($book) &&
									$Book == $bookId ? 'selected' : '';
									echo "<option value=\"$bookId\" $selected>
									$row->book_categories</option>";
								}
							}
						?>
				</select>

				<br><br>

				<label><span class="error">* </span>Select Comic Genre:</label>
				<select name="comic">
		        <option></option>
		        <?php
		          // Connection to database
		          $comic = $con->query(
		            'select * from comics');

		          if ($comic) {
		            while ($row = $comic->fetch_object()) {
		              $comicId = $row->comic_id;
		              $selected = isset($comic) &&
		              $Comic == $comicId ? 'selected' : '';
		              echo "<option value=\"$comicId\" $selected>
		              $row->comic_categories</option>";
		            }
		          }
		        ?>
		    </select>
			<!--  Book and Comic Preferences -->
			<!--
				<label><span class="error">* </span>Select Preference:</label>

					<input type="radio" name="preference" value="None">None
					<input type="radio" name="preference" value="Books">Books
					<input type="radio" name="preference" value="Comics">Comics
					<input type="radio" name="preference" value="Both">Both

				<br><br>
			-->
			<!--  Book Genres -->
			<!--
				<label>Select Book Genres:</label>
				<br><br>

					<input type="checkbox" name="book[]" value="Fiction">Fiction
					<input type="checkbox" name="book[]" value="Non-Fiction">Non-Fiction
					<input type="checkbox" name="book[]" value="Art">Art
					<input type="checkbox" name="book[]" value="Mystery">Mystery

				<br><br>

					<input type="checkbox" name="book[]" value="Action">Action
					<input type="checkbox" name="book[]" value="Romance">Romance
					<input type="checkbox" name="book[]" value="Horror">Horror
					<input type="checkbox" name="book[]" value="Poetry">Poetry

				<br><br>
-->
			<!--  Comic Genres -->
			<!--
				<label>Select Comic Genres:</label>

					<input type="radio" name="comic" value="none">None
					<input type="radio" name="comic" value="marvel">Marvel
					<input type="radio" name="comic" value="dc">DC
					<input type="radio" name="comic" value="both">Both

				<br><br>
			-->

				<br><br>

					<button>Submit</button>

		</form>
	<?php include ('./includes/footer.php');?>
