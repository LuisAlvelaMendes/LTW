<?php
	include_once('../includes/session.php');

	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_story.php');
	include_once('../templates/tpl_mustache.php');

	include_once('../database/db_story.php');
	include_once('../database/db_comments.php');

	$storyId = $_GET['id'];
	
	$storyMainInfo = getStoryMainInfoById($storyId);
	
	if(!isset($_SESSION['username'])) {
		draw_header(null, $storyMainInfo[0]['channel']);
	} else {
		draw_header($_SESSION['username'], $storyMainInfo[0]['channel']);
  	}

	draw_story_text($storyMainInfo[0]['title'], $storyMainInfo[0]['fulltext']);
	//draw_info_bar_story($storyId, $storyMainInfo[0]['author'], false, $storyMainInfo[0]['published'], $storyMainInfo[0]['points']);
	draw_comment_section($storyId);
    
	draw_footer();
?>