<?php
	include_once('../includes/database.php');

    $value = $_GET['value'];
    
    $db = Database::instance()->db();

    $matches = $db->prepare("SELECT id, title FROM Story WHERE title LIKE ? OR fulltext LIKE ?");	
    $matches->execute(array("%$value%", "%$value%"));
    $matches = $matches->fetchAll();

    echo json_encode($matches);
?>