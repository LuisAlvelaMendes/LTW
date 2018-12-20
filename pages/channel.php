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
		$subscribe = false;
	} else {
		draw_header($_SESSION['username'], $channel, $channel);
		$subscribe = channelSubscribed($channel);
	}	

	draw_errorMessages();

	$stories= getStoriesFromChannel($channel);

	if(count($stories) === 0)
		channel_no_stories();
	else
		draw_channelButtons($channel, $subscribe);
		drawStories($stories, $channel);

	draw_footer();
?>


  

