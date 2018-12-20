<?php 
	include_once('../includes/session.php'); 
	include_once('../templates/tpl_common.php');
?>

<?php // Draws edit button ?>
<?php function draw_edit_profile_button() { ?>
	<link rel="stylesheet" href="../css/edit.css"> 

	<button class="button" id="editButton" onclick="window.location.href='../pages/edit.php'"> Edit Profile Info </button>
<?php } ?>

<?php // Draws edit profile page ?>
<?php function draw_edit_profile() { ?>
	<link rel="stylesheet" href="../css/edit.css"> 

	<section id="edit">
		<div id="chngPass">
			<form action="../actions/action_editPass.php" method="post">
				<p> Change Password: </p>
			
				<label>Old Password</label>
				<input class="input" type="password" placeholder="Enter Old Password" name="oldpassword" required>

				<label>New Password</label>
				<input class="input"  type="password" placeholder="Enter New Password" name="newpassword" required>

				<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
				<button class="button" type="submit">Change</button>
			</form>
		</div>

		<div id="chngEmail">
			<form action="../actions/action_editEmail.php" method="post">

				<p> Change Email: </p>
			
				<label for="oldemail">Old Email</label>
				<input class="input"  type="email" placeholder="Enter Old email" name="oldemail" required>

				<label for="newemail">New Email</label>
				<input class="input" type="email" placeholder="Enter New Password" name="newemail" required>

				<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
				<button class="button" type="submit">Change</button>
			</form>
		</div>
	</section>
<?php } ?>

<?php // Draws stories posted by the user ?>
<?php function draw_posted_stories($username) { ?>
	<link rel="stylesheet" href="../css/profile.css">

	<section class="userHistory">
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

<?php // Draws comments posted by the user ?>
<?php function draw_posted_comments($username) { ?>
	<section class="userHistory">
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

<?php // Draws user account info ?>
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

<?php // Draws user subscribed channels ?>
<?php function draw_subscribedChannels($username) { ?>
  <link rel="stylesheet" href="../css/story.css">

  <section class="userHistory">
      <h3> User's Subscribed Channels: </h3>
      
      <?php 
      $subscribedChannelsNames = getSubscribedChannels($username);

      if(empty($subscribedChannelsNames)) { ?>
        <p> User has not subscribed to any channel..</p>
      <?php } else {
        foreach( $subscribedChannelsNames as $channelName) { ?>
          <p><a onclick="window.location.href='../pages/channel.php?name=<?=$channelName['channel']?>'"><?=$channelName['channel']?></a></p>
        <?php }
      } ?>
  </section>
<?php } ?>