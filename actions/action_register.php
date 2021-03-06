<?php
    include_once('../includes/session.php');
    include_once('../database/db_user.php');

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];


      // Don't allow certain characters
    if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers!');
        die(header('Location: ../pages/register.php'));
    } else if($password1 != $password2) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Passwords are not equal!');
        header('Location: ../pages/register.php');
    } else if(usernameExists($username)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username already in use!');
        header('Location: ../pages/register.php');
    } else if(emailExists($email)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Email already in use!');
        header('Location: ../pages/register.php');
    } else {
        addUser($username, $password1, $email);
        $_SESSION['username'] = $username;
        header('Location: ../pages/homepage.php');
    }
?>

