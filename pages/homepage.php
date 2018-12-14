<?php
	include_once('../includes/session.php');

	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_sub.php');
	include_once('../templates/tpl_story.php');

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

		foreach($allChannels as $channel){
			$mostRecent = getMostRecentStoryFromChannel($channel['name']);
			draw_storyCard($mostRecent[0], true);
		}

	} 
	else {
		$stories = getStoriesFromSubscribedChannels($_SESSION['username']);

		foreach($stories as $story){
			draw_storyCard($story, true);
		}
	}

	draw_footer();
?>
