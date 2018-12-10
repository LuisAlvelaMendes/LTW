

<?php function drawStories($stories, $channel) { ?>
	<link rel="stylesheet" href="../css/storyCard.css">
	<script src="../scripts/sortStories.js" async></script>
	<script src="../scripts/mustache.js" async></script>

	<input id="channel_name" type="hidden" name="channel" value="<?=$channel?>">

	<label> Sort by </label>
    <select id="sort">
      <option>Date</option>
      <option>Comments</option>
      <option>Points</option>
	</select>
	
	<section id="story_cards">
		<?php foreach($stories as $story) { ?>
			<div>
				<button id="storyCard" class="storyCards" onclick="window.location.href='../pages/story.php?id=<?=$story['id']?>'">
					<h1> <?=$story['title']?> </h1>
					<p> <?=$story['fulltext']?> </p>
					<p>&bull; &bull; &bull;</p>
				</button>

				<?php draw_info_bar_story($story['id'], $story['author'], null, $story['published'], $story['points']) ?>
			</div>
		<?php } ?>

	</section>
<?php } ?>

<?php function draw_createChannel() { ?>
	<link rel="stylesheet" href="../css/common.css">
	<form action='../actions/action_createChannel.php' method='post'>
		<input id="createChannelText" type='text' placeholder='Enter the channel name' name='name' required>
		<button id="createChannelButton" type='submit'>Create Channel</button>
	</form>
<?php } ?>

<?php function draw_subscribeButton($channel) { ?>
	<link rel="stylesheet" href="../css/common.css">
	<form action='../actions/action_subscribeChannel.php' method='post'>

		<input type="hidden" name="channel" value="<?=$channel?>">

		<button id = "subscribe" class = "button" type='submit'>Subscribe</button>
	</form>
<?php } ?>

<?php function draw_unsubscribeButton($channel) { ?>
	<link rel="stylesheet" href="../css/common.css">
	<form action='../actions/action_unsubscribeChannel.php' method='post'>

		<input type="hidden" name="channel" value="<?=$channel?>">

		<button id = "unsubscribe" class = "button" type='submit'>Unsubscribe</button>
	</form>
<?php } ?>

