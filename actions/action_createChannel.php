<?php
    include_once('../includes/session.php');
    include_once('../database/db_channel.php');

    $name = $_POST['name'];

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