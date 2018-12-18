<?php
	include_once('../includes/session.php');

	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_homepage.php');
	include_once('../templates/tpl_sub.php');

	include_once('../database/db_story.php');
	include_once('../database/db_channel.php');

	$topchannels = getTopChannels(); 

	if(!isset($_SESSION['username'])) {
		draw_header(null, 'Homepage', 'Homepage'); 
	} else {
		draw_header($_SESSION['username'], 'Homepage', 'Homepage');
	}

	draw_topchannels($topchannels);

	draw_homepage_buttons();

	if(!isset($_SESSION['username'])) {
		$allChannels = getAllChannels();

		draw_storiesFromChannels($allChannels);
	} else {
		$stories = getStoriesFromSubscribedChannels($_SESSION['username']);

		if(count($stories) === 0)
		{
			draw_no_stories();
		}
			
		draw_stories($stories);
	}

	draw_footer();
?>