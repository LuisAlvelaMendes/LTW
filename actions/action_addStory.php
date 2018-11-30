<?php

    include_once('../includes/session.php');
    include_once('../database/db_channel.php');

    $title = $_POST['title'];
    $channel = $_POST['channel'];
    $fulltext = $_POST['fulltext'];

    addStory($title, $channel, $fulltext);
    header("Location: ../pages/channel.php?name=$channel");

?>