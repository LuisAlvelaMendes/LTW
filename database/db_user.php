<?php
    include_once('../includes/database.php');

    function checkUserPassword($username, $password) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM utilizer WHERE username = ? AND password = ?');
        $stmt->execute(array($username, sha1($password)));
    
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    function getUserPublicInfo($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT email, points, created FROM Utilizer WHERE username = ?');
        $stmt->execute(array($username));
        
        return $stmt->fetchAll();
    }

    function usernameExists($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM utilizer WHERE username = ?');
        $stmt->execute(array($username));
    
        return $stmt->fetch()?true:false; // return true if username exists
    }

    function emailExists($email) {
        $db = Database::instance()->db();
        
        var_dump($email);

        $stmt = $db->prepare('SELECT * FROM utilizer WHERE email = ?');
        $stmt->execute(array($email));
    
        return $stmt->fetch()?true:false; // return true if email exists
    }

    function addUser($username, $password, $email) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO utilizer (username, password, email, created) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($username, sha1($password), $email, time()));
    }

    function getAllStoriesPosted($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT id, title FROM Story WHERE author = ?');
        $stmt->execute(array($username));

        return $stmt->fetchAll();
    }

    function getAllCommentsPosted($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT story_id, date, points, text FROM Comment WHERE username = ?');
        $stmt->execute(array($username));

        return $stmt->fetchAll();
    }

    function changeUserPassword($username, $password) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE utilizer SET password = ? WHERE username = ?');
        $stmt->execute(array(sha1($password), $username));
    
        return true;
    }

    function changeUserEmail($username, $email) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE utilizer SET email = ? WHERE username = ?');
        $stmt->execute(array($email, $username));
    
        return true;
    }
?>