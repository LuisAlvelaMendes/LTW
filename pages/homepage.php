<?php
	include_once('../includes/session.php');

	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_topsubs.php');
	include_once('../templates/tpl_story.php');
	include_once('../templates/tpl_subList.php');

	include_once('../database/db_channel.php');
	
	$channellist = array('pol', 'sci', 'fit', 'ocd', 'hrt');
	$numsubs = array('550', '420', '330', '210', '150');
	$channelid = array('68', '72', '44', '32', '69');

	if(!isset($_SESSION['username'])) {
		draw_header(null, 'NOT REDDIT');
	} else {
		draw_header($_SESSION['username'], 'NOT REDDIT');
	}

	draw_topsubs($channellist, $numsubs, $channelid);
	
  $mostRecent = getMostRecentStoryFromChannel('Portugal');
  draw_storyCard($mostRecent[0]);

  $mostRecent = getMostRecentStoryFromChannel('Lorem Ipsum');
  draw_storyCard($mostRecent[0]);

	draw_footer();
?>