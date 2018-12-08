<?php
	include_once('../includes/database.php');

    $value = $_GET['value'];
    
    $db = Database::instance()->db();

    $matches = $db->prepare("SELECT text, story_id, username FROM Comment WHERE text LIKE ?");	
    $matches->execute(array("%$value%"));
    $matches = $matches->fetchAll();

    echo json_encode($matches);
?>