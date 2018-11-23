<?php 
	include_once('../templates/tpl_common.php');
	include_once('../database/db_story.php');
?>

<?php function draw_storyCard($channel) { ?>
	<link rel="stylesheet" href="../css/storyCard.css">

	<?php 
		$mostRecent = getMostRecentStoryFromChannel($channel);
	?>

	<button id="storyCard" onclick="window.location.href='../pages/story.php?id=<?=$mostRecent[0]['id']?>'">
		<h1> <?=$mostRecent[0]['title']?> </h1>
		<p> <?=$mostRecent[0]['fulltext']?> </p>
		<p>&bull; &bull; &bull;</p>
	</button>
	
	<?php draw_info_bar($mostRecent[0]['author'], $channel, $mostRecent[0]['published']) ?>
<? } ?>