<?php
    include_once('../includes/session.php');
    include_once('../database/db_channel.php');

    $channel = $_POST['channel'];
    $username = $_SESSION['username'];

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Request does not appear to be legitimate!');
        die(header('Location: ../pages/homepage.php'));
    }

    unsubscribeChannel($username, $channel);
    header("Location: ../pages/channel.php?name=$channel");
?>