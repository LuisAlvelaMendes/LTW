<?php
    include_once('../includes/session.php');
    include_once('../database/db_user.php');

    $username = $_SESSION['username'];
    $oldemail = $_POST['oldemail'];
    $newemail = $_POST['newemail'];

    if (!emailExists($oldemail)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Old email is wrong!');
        header("Location: ../pages/edit.php");
    }

    else {
        if (changeUserEmail($username, $newemail)) {
            $_SESSION['username'] = $username;
            header('Location: ../pages/homepage.php');
        } else {
            $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Change email failed!');
            header("Location: ../pages/profile.php?name=$username");
        }
    }

?>