<?php 
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
		<h1> <?=htmlspecialchars($story['title'])?> </h1>
		<p> <?=htmlspecialchars($story['fulltext'])?> </p>

		<p>&bull; &bull; &bull;</p>
	</button>
	
	<?php draw_info_bar($story['author'], $channel, $story['published']) ?>
<?php } ?>

<?php function draw_addStory($channel) { ?>
	<form action='../actions/action_addStory.php' method='post'>
		<label for='title'>Title</label>
		<input type='text' placeholder='Enter the Story Title' name='title' required>
		
		<textarea name='fulltext' placeholder='Enter your story text' rows='4' column='50' required></textarea>
		
		<input type="hidden" name="channel" value="<?=$channel?>">

		<button type='submit'>Submit</button>
	</form>
<?php } ?>

<?php function draw_addComment($story) { ?>
	<form action='../actions/action_addComment.php' method='post'>
		<textarea name = 'text' placeholder='Enter your comment' rows='4' column='50'></textarea>
		
		<input type='hidden' name='story' value="<?=$story?>">
		<button type='submit'>Add</button>
	</form>
<?php } ?>
