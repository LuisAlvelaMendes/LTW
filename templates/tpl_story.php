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
		<h1> <?=$story['title']?> </h1>
		<p> <?=$story['fulltext']?> </p>
		<p>&bull; &bull; &bull;</p>
	</button>
	
	<?php draw_info_bar($story['author'], $channel, $story['published']) ?>
<?php } ?>
