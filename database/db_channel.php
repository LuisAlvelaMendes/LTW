<?php
	include_once('../includes/database.php');

	function getSubscribedChannels($username){
		$db = Database::instance()->db();

		$subscribedChannelsQuery = $db->prepare('SELECT channel FROM UserSubscriptions WHERE username = ?');
				
		$subscribedChannelsQuery->execute(array($username));
		$subscribedChannelsNames = $subscribedChannelsQuery->fetchAll();

		return $subscribedChannelsNames;
	}
?>
