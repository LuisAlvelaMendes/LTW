<?php 
	include_once('../includes/session.php');
	
	include_once('../templates/tpl_channel.php');
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_story.php');
	include_once('../templates/tpl_mustache.php');
	
	include_once('../database/db_channel.php');
	include_once('../database/db_story.php');

	$channel=$_GET['name'];

	if(!isset($_SESSION['username'])) {
		draw_header(null, $channel);

	} else {
		draw_header($_SESSION['username'], $channel);
		draw_addStory($channel);

		if(channelSubscribed($channel))
			draw_unsubscribeButton($channel);
		else
			draw_subscribeButton($channel);
	}	

	$stories= getStoriesFromChannel($channel);

	drawStories($stories, $channel);

	draw_footer();
?>


  

