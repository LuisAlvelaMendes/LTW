<?php
    include_once('../includes/database.php');

    function getSubscribedChannels($username){

        $subscribedChannelsQuery = $db->prepare('SELECT channel FROM userSubscriptions WHERE username = ?');
            
        $subscribedChannelsQuery->execute(array($username));
        $subscribedChannelsNames = $subscribedChannelsQuery->fetchAll();

        return $subscribedChannelsNames;
    }
?>
