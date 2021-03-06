<?php 
	include_once('../includes/session.php'); 
	
	include_once('../templates/tpl_story.php');

    include_once('../database/db_channel.php');
    include_once('../database/db_story.php') ;
?>

<?php // Draws button presen in the homepage.php ?>
<?php function draw_homepage_buttons() { ?>
	<link rel="stylesheet" href="../css/common.css">
	
	<section id = "homepage_buttons">
		<div id="left">
			<button id="searchButton" class="button" type='submit' onclick="window.location.href='../pages/search.php'"><i class="fas fa-search"></i>Search</button>
		</div>

		<?php if(isset($_SESSION['username'])) { ?>
			<div id="right">
				<form action='../actions/action_createChannel.php' method='post'>
					<input id="createChannelText" type='text' placeholder='Enter the channel name' name='name' required>
					<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
					<button id="createChannelButton" class="button" type='submit'>Create Channel</button>
				</form>
			</div>
		<?php } ?>
	</section>	
<?php } ?>

<?php // Draws stories from all channels ?>
<?php function draw_storiesFromChannels($allChannels) { ?>
	<script src="../scripts/voteStory.js" async></script>
	
	<section id="storyCards">
	<?php foreach($allChannels as $channel){
		$mostRecent = getMostRecentStoryFromChannel($channel['name']);

		if(!is_null($mostRecent[0]['id']))
			draw_storyCard($mostRecent[0], true);
	}?>
	</section>
<?php } ?>

<?php // Draws stories from subscribed channels ?>
<?php function draw_stories($stories) { ?>
	<script src="../scripts/voteStory.js" async></script>
	
	<section id="storyCards">
	<?php foreach($stories as $story){
		draw_storyCard($story, true);
	}?>
	</section>
<?php } ?>

<?php // Displays warning informing user that he is not subscribed to any channel ?>
<?php function draw_no_stories() { ?>	
	<link rel="stylesheet" href="../css/common.css">

	<section id="no_stories">
		<p> You are not subscribed to any channel. </p>
		<p> Subscribe now in order to see stories about your favourite topics here in your homepage! </p>
	</section>
<?php } ?>
