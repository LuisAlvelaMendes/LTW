<?php
	include_once('../includes/session.php');
    include_once('../templates/tpl_common.php');
    include_once('../database/db_story.php');

    $storyId = $_GET['id'];

    $storyMainInfo = getStoryMainInfoById($storyId);

	if(!isset($_SESSION['username'])) {
		draw_header(null, $storyMainInfo[0]['channel']);
	} else {
		draw_header($_SESSION['username'], $storyMainInfo[0]['channel']);
    }

    draw_story_text($storyMainInfo[0]['title'], $storyMainInfo[0]['fulltext']);
    draw_info_bar($storyMainInfo[0]['author'], $storyMainInfo[0]['channel'], $storyMainInfo[0]['published']);
	
	draw_footer();
?>