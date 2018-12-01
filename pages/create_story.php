<?php 
	include_once('../includes/session.php');
	
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_story.php');
	
	include_once('../database/db_channel.php');
	include_once('../database/db_story.php');

	$channel=$_GET['name'];

	draw_header($_SESSION['username'], $channel);	

	draw_textareas($channel);

	draw_footer();
?>
