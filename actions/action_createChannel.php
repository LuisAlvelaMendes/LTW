<?php
    include_once('../includes/session.php');
    include_once('../database/db_channel.php');

    $name = $_POST['name'];

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Request does not appear to be legitimate!');
        die(header('Location: ../pages/homepage.php'));
    }
    
    // Don't allow certain characters
    if ( !preg_match ("/^[a-z A-Z0-9]+$/", $name)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Channels names can only contain letters, numbers or spaces!');
        die(header('Location: ../pages/homepage.php'));
    }

    if (channelExists($name)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Channel with same name already exists!');
        header("Location: ../pages/homepage.php");
    }

    createChannel($name);
    header("Location: ../pages/channel.php?name=$name");
?>