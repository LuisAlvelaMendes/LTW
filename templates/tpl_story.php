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
	<style>
	*
	{
		font-family: Verdana, sans-serif;
	}
	#title_label
	{
		position: relative;
		font-size: 30px;
		top:30px;
	}
	#story_title
	{
		position: relative;
		top: 75px;
		right: 70px;
		margin-bottom: 50px;
		padding-top: 5px;
	}
	#text_label
	{
		position: relative;
		font-size: 30px;
		top: 130px;
		right: 660px;
	}
	#textarea
	{
		position: relative;
		top: 100px;
		margin-bottom: 100px; 
	}
	#submit
	{
		position: relative;
		left:50px;
		top: 28px;
	}
	</style>
	<form action='../actions/action_addStory.php' method='post'>	
		<label id = "title_label" for='title'>Title</label>
		<input id = "story_title" type='text' placeholder='Enter the Story Title' name='title' size="70" required autofocus>

		<label id = "text_label" for='text'>Text</label>
		<textarea id = "textarea" name='fulltext' placeholder='Enter your story text' rows='10' cols="70" required ></textarea>

		<input type="hidden" name="channel" value="<?=$channel?>">

		<button id="submit" type='submit' class = "button">Submit</button>
	</form>

<?php } ?>

<?php function draw_comment_section($storyId) { ?>
	<link rel="stylesheet" href="../css/story.css">
	<script src="../scripts/addComment.js" defer></script>
	<script src="../includes/mustache.js" async></script>

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

	<section id="comment_section"></section>
<?php } ?>