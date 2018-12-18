<?php 
	include_once('../includes/session.php');

	include_once('../templates/tpl_common.php');
	include_once('../database/db_story.php');
?>

<!-- Draws story card used in homepage and channel-->
<?php function draw_storyCard($story, $displayChannel) { ?>
	<link rel="stylesheet" href="../css/storyCard.css">

	<?php if($displayChannel) {
		$channel = $story['channel'];
	} else {
		$channel = null;
	} ?>

	<div>
		<button class="storyCardButton" onclick="window.location.href='../pages/story.php?id=<?=$story['id']?>'">
			<h1> <?=$story['title']?> </h1>
			<p> <?=$story['fulltext']?> </p>

			<p>&bull; &bull; &bull;</p>
		</button>
		<?php draw_info_bar_story($story['id'], $story['author'], $channel, $story['published'], $story['points']) ?>
	</div>
<?php } ?>

<!-- Draws complete story -->
<?php function draw_story($story) { ?>
	<link rel="stylesheet" href="../css/story.css">

	<script src="../scripts/voteStory.js" async></script>

	<?php $newtext = draw_references($story[0]['fulltext']); ?>

	<section id ="storyCards">
		<section id="storyText">
			<h1><?=$story[0]['title']?></h1>
			<p><?=$newtext?></p>
		</section>
		<?php draw_info_bar_story($story[0]['id'], $story[0]['author'], false, $story[0]['published'], $story[0]['points']); ?>
	</section>
<?php } ?>

<!-- Draws input for new story -->
<?php function draw_textareas($channel) { ?>
	<link rel="stylesheet" href="../css/story.css">

	<form id = "createStory" action='../actions/action_addStory.php' method='post'>	
		<label id = "title_label" for='title'>Title</label>
		<input id = "story_title" type='text' name='title' size="70" required autofocus>

		<label id = "text_label" for='text'>Text</label>
		<textarea id = "textarea" name='fulltext' rows='15' cols="70" required ></textarea>

		<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
		<input type="hidden" name="channel" value="<?=$channel?>">

		<button id="submit" type='submit' class = "button">Submit</button>
	</form>

<?php } ?>

<!-- Draws comment input for the story -->
<?php function draw_comment_section($storyId) { ?>
	<link rel="stylesheet" href="../css/story.css">
	
	<script src="../scripts/voteComment.js" defer></script>
	<script src="../scripts/addComment.js" defer></script>
	<script src="../includes/mustache.js" defer></script>

	<?php if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	} else {
		$username = -1;
	} ?>

	<input id="username" type="hidden" name="username" value=<?=$username?>> 

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
			<textarea name="comment" placeholder="Add your comment" required></textarea>
			<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
			<input type="hidden" name="story" value="<?=$storyId?>">
			<input type="submit" value="Add">
		</form>
	<?php } ?>

	<section id="comment_section"></section>
<?php } ?>