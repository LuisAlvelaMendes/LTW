<?php 
	include_once('../includes/session.php'); 
	
	include_once('../templates/tpl_story.php');

    include_once('../database/db_channel.php');
    include_once('../database/db_story.php') ;
?>

<!-- Draws button presen in the homepage.php -->
<?php function draw_homepage_buttons() { ?>
	<link rel="stylesheet" href="../css/common.css">
	
	<section id = "homepage_buttons">
		<div id="left">
			<button id="searchButton" class="button" type='submit' onclick="window.location.href='../pages/search.php'">Search</button>
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

<!-- Draws stories from all channels -->
<?php function draw_storiesFromChannels($allChannels) { ?>
	<script src="../scripts/voteStory.js" async></script>
	
	<section id="storyCards">
	<?php foreach($allChannels as $channel){
        $mostRecent = getMostRecentStoryFromChannel($channel['name']);
		draw_storyCard($mostRecent[0], true);
	}?>
	</section>
<?php } ?>

<!-- Draws stories from subscribed channels -->
<?php function draw_stories($stories) { ?>
	<script src="../scripts/voteStory.js" async></script>
	
	<section id="storyCards">
	<?php foreach($stories as $story){
		draw_storyCard($story, true);
	}?>
	</section>
<?php } ?>

<?php function draw_no_stories() { ?>	
	<link rel="stylesheet" href="../css/common.css">

	<section id="no_stories">
		<p> You are not subscribed to any channel. </p>
		<p> Subscribe now in order to see stories about your favourite topics here in your homepage! </p>
	</section>
<?php } ?>

<?php function draw_topchannels($topchannels) { ?>
	<link rel="stylesheet" href="../css/top_subs.css">

	<section id="top_ch">
		<? foreach($topchannels as $channel) { ?>
		<button type="button" onclick="window.location.href='../pages/channel.php?name=<?= $channel['name'] ?>'">
			<h1><?=$channel['name']?></h1>
			<h2><?=$channel['subscribers']?></h2>
		</button>
		<? } ?>
	</section> 
<?php } ?>