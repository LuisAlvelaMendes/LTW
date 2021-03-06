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

	function subscribeChannel($username, $channel) {		
		$db = Database::instance()->db();

		$stmt = $db->prepare('INSERT INTO UserSubscriptions VALUES (?, ?)');
		$stmt->execute(array($username, $channel));
	}

	function unsubscribeChannel($username, $channel) {		
		$db = Database::instance()->db();

		$stmt = $db->prepare('DELETE FROM UserSubscriptions WHERE username = ? AND channel = ?');
		$stmt->execute(array($username, $channel));
	}

	function channelSubscribed($channel) {
		$db = Database::instance()->db();

		$stmt = $db->prepare('SELECT * FROM UserSubscriptions WHERE username = ? AND channel = ?');
		$stmt->execute(array($_SESSION['username'], $channel));

		return $stmt->fetch()?true:false; // return true if user subscribed to channel
	}

	function getSubscribedChannels($username) {
		$db = Database::instance()->db();

		$subscribedChannelsQuery = $db->prepare('SELECT channel FROM UserSubscriptions WHERE username = ?');
				
		$subscribedChannelsQuery->execute(array($username));
		$subscribedChannelsNames = $subscribedChannelsQuery->fetchAll();

		return $subscribedChannelsNames;
	}

	function getAllChannels() {
		$db = Database::instance()->db();

		$allChannels = $db->prepare('SELECT name FROM Channel');
				
		$allChannels->execute();
		$allChannelNames = $allChannels->fetchAll();

		return $allChannelNames;
	}

	function getTopChannels() {
		$db = Database::instance()->db();

		$topChannels = $db->prepare('SELECT name, count(*) as subscribers FROM Channel left join UserSubscriptions WHERE name = channel GROUP BY name ORDER BY subscribers DESC LIMIT 5');
				
		$topChannels->execute();
		$topChannelNames = $topChannels->fetchAll();

		return $topChannelNames;
	}

	function getNumberOfSubscribers($channel)
	{
		$db = Database::instance()->db();

		$subscribers = $db->prepare('SELECT count(*) as subscribers FROM UserSubscriptions WHERE channel = ?');
				
		$subscribers->execute(array($channel));
		$subscribers = $subscribers->fetchAll();

		return $subscribers;
	}

	function addStory($title, $channel, $fulltext) {
		$db = Database::instance()->db();

		$stmt = $db->prepare('INSERT INTO story (title, published, channel, author, fulltext) VALUES (?, ?, ?, ?, ?)');
		$stmt->execute(array($title, time(), $channel, $_SESSION['username'], $fulltext));
	}
?>
