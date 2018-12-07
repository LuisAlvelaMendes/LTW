<?php

	include_once('../includes/database.php');

	$channel = $_GET['channel'];

	$db = Database::instance()->db();

	$storiesFromChannel = $db->prepare('SELECT * FROM Story WHERE channel = ? ORDER BY points DESC');	
	$storiesFromChannel->execute(array($channel));
	$stories = $storiesFromChannel->fetchAll();
	 
	echo json_encode($stories);
?>	