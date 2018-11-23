<?php
    include_once('../includes/database.php');

    function getStoriesFromChannel($channel){
        $db = Database::instance()->db();

        $storiesFromChannel = $db->prepare('SELECT title, fulltext, published, author FROM Story WHERE channel = ?');
            
        $storiesFromChannel->execute(array($channel));
        $storiesFromChannel = $storiesFromChannel->fetchAll();

        return $storiesFromChannel;
    }

    function getMostRecentStoryFromChannel($channel){
        $db = Database::instance()->db();

        $recentStory = $db->prepare('SELECT id, title, fulltext, MAX(published) AS "published", author FROM Story  WHERE channel = ?');
            
        $recentStory->execute(array($channel));
        $recentStory = $recentStory->fetchAll();

        return $recentStory;
    }
?>