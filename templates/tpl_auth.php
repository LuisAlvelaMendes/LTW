<?php function draw_login() { ?>
	<link rel="stylesheet" href="../css/auth.css"> 

	<section id="login">
		<form action="../actions/action_login.php" method="post">
				<label for="username">Username</label>
				<input type="text" placeholder="Enter Username" name="username" required autofocus>

				<label for="password">Password</label>
				<input type="password" placeholder="Enter Password" name="password" required>

				<button type="submit">Login</button>
		</form>
	</section>
<? } ?>

<?php function draw_register() { ?>
	<link rel="stylesheet" href="../css/auth.css"> 

	<section id="login">
		<form action="../actions/action_register.php" method="post">
				<label for="username">Username</label>
				<input type="text" placeholder="Enter Username" name="username" required autofocus>

				<label for="password">Password</label>
				<input type="password" placeholder="Enter Password" name="password1" required>

				<label for="Repeat password">Password</label>
				<input type="password" placeholder="Repeat Password" name="password2" required>

				<button type="submit">Register</button>
		</form>
	</section>
<? } ?>