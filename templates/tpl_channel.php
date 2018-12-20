<?php 
	include_once('../templates/tpl_common.php'); 
	include_once('../includes/session.php');
?>

<?php // Draws stories on channel ?>
<?php function drawStories($stories, $channel) { ?>
	<link rel="stylesheet" href="../css/storyCard.css">

	<section id="storyCards">
		<?php foreach($stories as $story) {
			draw_storyCard($story, false);
		} ?>
	</section>
<?php } ?>

<?php // Draws sort stories add story and subscribe button ?>
<?php function draw_channelButtons($channel, $subscribe) { ?>
	<link rel="stylesheet" href="../css/channel.css">

	<script src="../scripts/voteStory.js" defer></script>
	<script src="../scripts/sortStories.js" async></script>
	<script src="../includes/mustache.js" async></script>

	<?php if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	} else {
		$username = -1;
	} ?>

	<section id="channelButtons">
		
		<section id="sortStories">
			<input id="channel_name" type="hidden" name="channel" value="<?=$channel?>">
			<input id="username" type="hidden" name="username" value="<?=$username?>">

			<label id="sortLabel"> Sort by </label>
			<select id="sort">
				<option>Date</option>
				<option>Comments</option>
				<option>Points</option>
			</select>
		</section>
	
		<?php if($username != -1) { ?>
			<?php draw_addStory($channel); ?>
			
			<?php if($subscribe) {
				draw_unsubscribeButton($channel);
			} else {
				draw_subscribeButton($channel);
			} ?>
		<?php } ?>
		
	</section>
<?php } ?>

<?php // Draws add story button ?>
<?php function draw_addStory($channel) { ?>
	<section id="addStory">
		<input type="hidden" name="channel" value="<?=$channel?>">
		<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
		<button id = "createStory" class = "button" onclick="window.location.href='../pages/create_story.php?name=<?=$channel?>'">Create Story</button>
	</section>
<?php } ?>

<?php // Draws subscribe Button ?>
<?php function draw_subscribeButton($channel) { ?>
	<section id="drawSubscribe">
		<form action='../actions/action_subscribeChannel.php' method='post'>
			<input type="hidden" name="channel" value="<?=$channel?>">
			<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
			<button id = "subscribe" class = "button" type='submit'>Subscribe</button>
		</form>
	</section>
<?php } ?>

<?php // Draws unsubscribe Button ?>
<?php function draw_unsubscribeButton($channel) { ?>
	<section id="drawUnsubscribe">
		<form action='../actions/action_unsubscribeChannel.php' method='post'>
			<input type="hidden" name="channel" value="<?=$channel?>">
			<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
			<button id = "unsubscribe" class = "button" type='submit'>Unsubscribe</button>
		</form>
	</section>
<?php } ?>

