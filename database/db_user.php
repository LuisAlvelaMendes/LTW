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

        $stmt = $db->prepare('SELECT points, created FROM Utilizer WHERE username = ?');
        $stmt->execute(array($username));
        
        return $stmt->fetchAll();
    }

    function usernameExists($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM utilizer WHERE username = ?');
        $stmt->execute(array($username));
    
        return $stmt->fetch()?true:false; // return true if username exists
    }

    function addUser($username, $password) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO utilizer (username, password, created) VALUES (?, ?, ?)');
        $stmt->execute(array($username, sha1($password), time()));
    }

    function getAllStoriesPosted($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT id, title FROM Story WHERE author = ?');
        $stmt->execute(array($username));

        return $stmt->fetchAll();
    }

    function getAllCommentsPosted($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT id FROM Comment WHERE username = ?');
        $stmt->execute(array($username));

        return $stmt->fetchAll();
    }

?>