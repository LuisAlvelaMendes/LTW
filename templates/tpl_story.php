<?php 
	include_once('../includes/session.php');

	include_once('../templates/tpl_common.php');
	include_once('../database/db_story.php');
?>

<?php function draw_storyCard($story, $displayChannel) { ?>
	<link rel="stylesheet" href="../css/storyCard.css">

	<?php if($displayChannel) {
		$channel = $story['channel'];
	} else {
		$channel = null;
	} ?>

	<button id="storyCard" onclick="window.location.href='../pages/story.php?id=<?=$story['id']?>'">
		<h1> <?=$story['title']?> </h1>
		<p> <?=$story['fulltext']?> </p>

		<p>&bull; &bull; &bull;</p>
	</button>
	
	<?php draw_info_bar_story($story['id'], $story['author'], $channel, $story['published'], $story['points']) ?>
<?php } ?>

<?php function draw_addStory($channel) { ?>
	<input type="hidden" name="channel" value="<?=$channel?>">

	<button id = "createStory" class = "button" onclick="window.location.href='../pages/create_story.php?name=<?=$channel?>'">Create Story</button>
<?php } ?>

<?php function draw_textareas($channel) { ?>
	<form action='../actions/action_addStory.php' method='post'>	
		<label id = "create_story_label" for='title'>Title</label>
		<input id = "create_story_title" type='text' placeholder='Enter the Story Title' name='title' required>
		<textarea name='fulltext' placeholder='Enter your story text' rows='4' column='50' required></textarea>

		<input type="hidden" name="channel" value="<?=$channel?>">

		<button type='submit' class = "button">Submit</button>
	</form>

<?php } ?>

<?php function draw_comment_section($storyId) { ?>
	<link rel="stylesheet" href="../css/story.css">
	<script src="../scripts/addComment.js" defer></script>

	<h3 id="comments"> Comment Section: </h3>
	
	<?php if(!isset($_SESSION['username'])) { ?>
		<form>
			<textarea name="comment" placeholder="Add your comment"></textarea>
			<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
			<input type="hidden" name="story" value="<?=$storyId?>">
			<input type="submit" value="Add" disabled>
		</form>
	<?php } else {?>
		<form>
			<textarea name="comment" placeholder="Add your comment"></textarea>
			<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
			<input type="hidden" name="story" value="<?=$storyId?>">
			<input type="submit" value="Add">
		</form>
	<?php } ?>

		<div id="chat"></div>
<?php } ?>