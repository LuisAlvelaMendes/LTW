<?php
    include_once('../includes/database.php');

    function checkUserPassword($username, $password) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM utilizer WHERE username = ? AND password = ?');
        $stmt->execute(array($username, sha1($password)));
        
        return $stmt->fetch()?true:false; // return true if a line exists
    }
?>