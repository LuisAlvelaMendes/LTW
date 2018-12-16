<?php
	include_once('../includes/session.php');

	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_homepage.php');

	include_once('../database/db_story.php');
	include_once('../database/db_channel.php');

	$topchannels = getTopChannels(); 

	if(!isset($_SESSION['username'])) {
		draw_header(null, 'NOT REDDIT'); 
	} else {
		draw_header($_SESSION['username'], 'NOT REDDIT');
	}

	draw_topchannels($topchannels);

	draw_homepage_buttons();

	if(!isset($_SESSION['username'])) {
		$allChannels = getAllChannels();

		draw_storiesFromChannels($allChannels);
	} else {
		$stories = getStoriesFromSubscribedChannels($_SESSION['username']);

		draw_stories($stories);
	}

	draw_footer();
?>