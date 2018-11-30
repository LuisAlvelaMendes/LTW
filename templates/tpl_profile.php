<?php include_once('../includes/session.php') ?>

<?php function draw_edit_profile_button() { ?>
	<link rel="stylesheet" href="../css/auth.css"> 

	<button id="editButton" onclick="window.location.href='../pages/edit.php'"> Edit Profile Info </button>
<?php } ?>

<?php function draw_edit_profile() { ?>
	<link rel="stylesheet" href="../css/auth.css"> 

	<section id="edit">
		<form action="../actions/action_edit.php" method="post">
			<label for="username">Username</label>
			<input type="text" placeholder="Enter Username" name="username" required autofocus>
		
            <label for="oldpassword">Old Password</label>
			<input type="password" placeholder="Enter Old Password" name="oldpassword" required>

			<label for="newpassword">New Password</label>
			<input type="password" placeholder="Enter New Password" name="newpassword" required>

			<button type="submit">Change</button>
		</form>
	</section>
<?php } ?>