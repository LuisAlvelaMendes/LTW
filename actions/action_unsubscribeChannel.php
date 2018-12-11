<?php
    include_once('../includes/session.php');
    include_once('../database/db_channel.php');

    $channel = $_POST['channel'];

    unsubscribeChannel($channel);
    header("Location: ../pages/channel.php?name=$channel");
?>