<?php
    include_once('../includes/session.php');
    include_once('../database/db_user.php');

    $username = $_SESSION['username'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Request does not appear to be legitimate!');
        die(header('Location: ../pages/homepage.php'));
    }
    
    if (!checkUserPassword($username, $oldpassword)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Old password is wrong!');
        header("Location: ../pages/edit.php");
    }

    else {
        if (changeUserPassword($username, $newpassword)) {
            $_SESSION['username'] = $username;
            header("Location: ../pages/profile.php?name=$username");
        } else {
            $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Change password failed!');
            header("Location: ../pages/profile.php?name=$username");
        }
    }

?>