<?php

    include_once('../includes/session.php');
    include_once('../database/db_channel.php');

    $name = $_POST['name'];

    // Don't allow certain characters
    if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Channels can only contain letters and numbers!');
        die(header('Location: ../pages/homepage.php'));
    }

    if(channelExists($name))
    {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Channel with same name already exists!');
        header("Location: ../pages/homepage.php");
    }

    createChannel($name);
    header("Location: ../pages/channel.php?name=$name");

?>