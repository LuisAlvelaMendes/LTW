<?php 
	include_once('../includes/session.php');
	
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_story.php');
	
	include_once('../database/db_story.php');

	$channel=$_GET['name'];

	if(!isset($_SESSION['username'])) {
		draw_header(null, $channel);
	} else {
		draw_header($_SESSION['username'], $channel);
	}

	$stories=getStoriesFromChannel($channel);

	foreach($stories as $story){
		draw_storyCard($story, false);
	}

	draw_footer();
?>


  

