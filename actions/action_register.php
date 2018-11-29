<?php
    include_once('../includes/session.php');
    include_once('../database/db_user.php');

    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if($password1 != $password2)
    {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Passwords are not equal!');
        header('Location: ../pages/register.php');
    }

    else if(usernameExists($username))
    {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username already in use!');
        header('Location: ../pages/register.php');
    }

    else
    {
        addUser($username, $password1);
        $_SESSION['username'] = $username;
        header('Location: ../pages/homepage.php');
    }
?>

