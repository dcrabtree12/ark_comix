<?php

	include ('main_header.html');
	include ('includes/logout-button.php');
?>
		<!-- Welcome information with sign up -->
		<div id="welcome">
			<h3>Having a membership will give you easier access to your favorite books and comics!</h3>
			<h2>Get a free gift card today.</h2>

			<a href="signUp.php" style="color: #ffffff;">Sign Up</a> <!-- Sign Up form -->
		</div>

		<div id="box" class="indent boxes">
			<h4 class="header">Box 1</h4>
			<img src="./images/design/greenBook.png" alt="" height="100px" width="100px">
			<p>Comics are great.</p>
		</div>

		<div id="box2" class="indent boxes">
			<h4>Box 2</h4>
			<p>Books are great!</p>
		</div>

		<div id="sidebar" class="indent">
			<h4>Side Bar</h4>
			<p>Users will be able to see upcoming sales.</p>
		</div>

	</div>
	<?php include ('includes/footer.php');?>
