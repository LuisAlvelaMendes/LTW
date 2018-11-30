<?php
    include_once('../includes/session.php');
    include_once('../database/db_changePass.php');
    include_once('../database/db_user.php');

    $username = $_POST['username'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];

    if(!checkUserPassword($username, $oldpassword)){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Old password is wrong!');
        header("Location: ../pages/profile.php?name=$username");
    }

    if (changeUserPassword($username, $newpassword)) {
        $_SESSION['username'] = $username;
        header('Location: ../pages/homepage.php');
    } else {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Change password failed!');
        header("Location: ../pages/profile.php?name=$username");
    }
?>