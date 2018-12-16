<?php include_once('../templates/tpl_common.php'); ?>

<?php function drawStories($stories, $channel) { ?>
	<link rel="stylesheet" href="../css/storyCard.css">
	
	<script src="../scripts/voteStory.js" async></script>
	<script src="../scripts/sortStories.js" async></script>
	<script src="../includes/mustache.js" async></script>
	
	<section id="sortStories">
		<label> Sort by </label>
		<select id="sort">
		<option>Date</option>
		<option>Comments</option>
		<option>Points</option>
		</select>
	</section>
	
	<section id="storyCards">
		<?php foreach($stories as $story) {
			draw_storyCard($story, false);
		} ?>
	</section>
<?php } ?>

<?php function draw_addStory($channel) { ?>
	<section id="addStory">
		<input type="hidden" name="channel" value="<?=$channel?>">
		<button id = "createStory" class = "button" onclick="window.location.href='../pages/create_story.php?name=<?=$channel?>'">Create Story</button>
	</section>
<?php } ?>

<?php function draw_subscribeButton($channel) { ?>
	<section id="drawSubscribe">
		<form action='../actions/action_subscribeChannel.php' method='post'>
			<input type="hidden" name="channel" value="<?=$channel?>">
			<button id = "subscribe" class = "button" type='submit'>Subscribe</button>
		</form>
	</section>
<?php } ?>

<?php function draw_unsubscribeButton($channel) { ?>
	<section id="drawUnsubscribe">
		<form action='../actions/action_unsubscribeChannel.php' method='post'>
			<input type="hidden" name="channel" value="<?=$channel?>">
			<button id = "unsubscribe" class = "button" type='submit'>Unsubscribe</button>
		</form>
	</section>
<?php } ?>

