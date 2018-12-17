<?php
    include_once('../includes/session.php');
    include_once('../database/db_user.php');

    $username = $_SESSION['username'];
    $oldemail = $_POST['oldemail'];
    $newemail = $_POST['newemail'];

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Request does not appear to be legitimate!');
        die(header('Location: ../pages/homepage.php'));
    }
    
    if (!emailExists($oldemail)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Old email is wrong!');
        header("Location: ../pages/edit.php");
    }

    else {
        if (changeUserEmail($username, $newemail)) {
            $_SESSION['username'] = $username;
            header("Location: ../pages/profile.php?name=$username");
        } else {
            $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Change email failed!');
            header("Location: ../pages/profile.php?name=$username");
        }
    }

?>