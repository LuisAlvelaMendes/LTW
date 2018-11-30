<?php
	include_once('../includes/database.php');

	function createChannel($name) {
		$db = Database::instance()->db();

		$stmt = $db->prepare('INSERT INTO channel (name) VALUES (?)');
		$stmt->execute(array($name));

	}

	function channelExists($name) {
		$db = Database::instance()->db();

		$stmt = $db->prepare('SELECT * FROM channel WHERE name = ?');
		$stmt->execute(array($name));

		return $stmt->fetch()?true:false; // return true if channel with same name exists

	}

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
