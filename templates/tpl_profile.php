<?php 
	include_once('../includes/session.php'); 
	include_once('../templates/tpl_common.php');
?>

<!-- Draws edit button -->
<?php function draw_edit_profile_button() { ?>
	<link rel="stylesheet" href="../css/auth.css"> 

	<button id="editButton" onclick="window.location.href='../pages/edit.php'"> Edit Profile Info </button>
<?php } ?>

<!-- Draws edit profile page -->
<?php function draw_edit_profile() { ?>
	<link rel="stylesheet" href="../css/edit.css"> 

	<section id="edit">
		<form action="../actions/action_editPass.php" method="post">

			<p> Change Password: </p>
		
            <label for="oldpassword">Old Password</label>
			<input type="password" placeholder="Enter Old Password" name="oldpassword" required>

			<br>

			<label for="newpassword">New Password</label>
			<input type="password" placeholder="Enter New Password" name="newpassword" required>

			<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
			<button type="submit">Change</button>
		</form>

		<form action="../actions/action_editEmail.php" method="post">

			<p> Change Email: </p>
		
			<label for="oldemail">Old Email</label>
			<input type="email" placeholder="Enter Old email" name="oldemail" required>

			<br>

			<label for="newemail">New Email</label>
			<input type="email" placeholder="Enter New Password" name="newemail" required>

			<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
			<button type="submit">Change</button>
		</form>
	</section>
<?php } ?>

<!-- Draws stories posted by the user -->
<?php function draw_posted_stories($username) { ?>
	<link rel="stylesheet" href="../css/profile.css">

	<section id="subscriptions">
		<h3> User's Posted Stories: </h3>
		
		<?php 
		$postedStoriesId = getAllStoriesPosted($username);

		if(empty($postedStoriesId)) { ?>
		<p> User has not posted any story..</p>
		<?php } else {
		foreach($postedStoriesId as $story) { ?>
			<p><a onclick="window.location.href='../pages/story.php?id=<?=$story['id']?>'"><?=$story['title']?></a></p>
		<?php }
		} ?>
	</section>
<?php } ?>

<!-- Draws comments posted by the user -->
<?php function draw_posted_comments($username) { ?>
	<section id="subscriptions">
		<h3> User's Posted Comments: </h3>
		
		<?php 
		$postedComments = getAllCommentsPosted($username);

		if(empty($postedComments)) { ?>
		<p> User has not posted any comment..</p>
		<?php } else {
		foreach($postedComments as $comment) { ?>
			<p><a onclick="window.location.href='../pages/story.php?id=<?=$comment['story_id']?>'"> <?=$comment['text']?> </a></p>
		<?php }
		} ?>
	</section>
<?php } ?>

<!-- Draws user account info -->
<?php function draw_user_info($username, $created, $points, $email) { ?>
	<?php $data = convert_epoch($created) ?>
	
	<link rel="stylesheet" href="../css/story.css">

	<section id="storyText">
		<h1>The user is: <?=$username?></h1>
		<p>Email: <?=$email?></p>
		<p>Account created in: <?=$data->format('Y-m-d')?></p>
		<p>Points: <?=$points?></p>
	</section>

<?php } ?>