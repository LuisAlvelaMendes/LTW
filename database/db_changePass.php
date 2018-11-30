<?php
    include_once('../includes/database.php');

    function changeUserPassword($username, $password) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE utilizer SET password = ? WHERE username = ?');
    
        return true;
    }
?>