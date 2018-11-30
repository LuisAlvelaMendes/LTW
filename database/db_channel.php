<?php
	include_once('../includes/database.php');

	function getSubscribedChannels($username){
		$db = Database::instance()->db();

		$subscribedChannelsQuery = $db->prepare('SELECT channel FROM UserSubscriptions WHERE username = ?');
				
		$subscribedChannelsQuery->execute(array($username));
		$subscribedChannelsNames = $subscribedChannelsQuery->fetchAll();

		return $subscribedChannelsNames;
	}

	function addStory($title, $channel, $fulltext)
	{
		$db = Database::instance()->db();

		$stmt = $db->prepare('INSERT INTO story (title, published, channel, author, fulltext) VALUES (?, ?, ?, ?, ?)');
		$stmt->execute(array($title, time(), $channel, $_SESSION['username'], $fulltext));

	}
?>
