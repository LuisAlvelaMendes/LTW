<?php
    include_once('../includes/session.php');
    include_once('../database/db_channel.php');

    $title = $_POST['title'];
    $channel = $_POST['channel'];
    $fulltext = $_POST['fulltext'];

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Request does not appear to be legitimate!');
        die(header('Location: ../pages/homepage.php'));
    }

    addStory(htmlspecialchars($title), $channel, htmlspecialchars($fulltext));
    header("Location: ../pages/channel.php?name=$channel");
?>