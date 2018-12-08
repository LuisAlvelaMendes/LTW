<?php
	include_once('../includes/database.php');

    $value = $_GET['value'];
    
    $db = Database::instance()->db();

    $matches = $db->prepare("SELECT name FROM Channel WHERE name LIKE ?");	
    $matches->execute(array("%$value%"));
    $matches = $matches->fetchAll();

    echo json_encode($matches);
?>