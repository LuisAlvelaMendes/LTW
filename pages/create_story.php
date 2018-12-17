<?php 
	include_once('../includes/session.php');
	
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_story.php');
	
	include_once('../database/db_channel.php');
	include_once('../database/db_story.php');

	$channel=$_GET['name'];

	if(!isset($_SESSION['username']))
	{
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'You do not have permission to access that page!');
		die(header('Location: homepage.php'));
	}

	draw_header($_SESSION['username'], $channel);	

	draw_textareas($channel);

	draw_footer();
?>
