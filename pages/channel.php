<?php 
	include_once('../includes/session.php');
	
	include_once('../templates/tpl_channel.php');
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_story.php');
	include_once('../templates/tpl_mustache.php');
	
	include_once('../database/db_channel.php');
	include_once('../database/db_story.php');

	$channel=$_GET['name'];

	if(!channelExists($channel))
	{
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Channel does not exist!');
		die(header('Location: homepage.php'));
	}

	if(!isset($_SESSION['username'])) {
		draw_header(null, $channel, $channel);

	} else {
		draw_header($_SESSION['username'], $channel, $channel);
	}	

	$stories= getStoriesFromChannel($channel);

	draw_channelButtons($channel, channelSubscribed($channel));

	drawStories($stories, $channel);

	draw_footer();
?>


  

