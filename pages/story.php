<?php
	include_once('../includes/session.php');

	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_story.php');
	include_once('../templates/tpl_mustache.php');

	include_once('../database/db_story.php');
	include_once('../database/db_comments.php');

	$storyId = $_GET['id'];
	
	$story = getStoryMainInfoById($storyId);
	
	if(!isset($_SESSION['username'])) {
		draw_header(null, $story[0]['channel']);
	} else {
		draw_header($_SESSION['username'], $story[0]['channel']);
  	}
	
	draw_story($story);
	
	draw_comment_section($storyId);
    
	draw_footer();
?>