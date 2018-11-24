<?php
    include_once('../includes/database.php');

    function getCommentsFromStory($storyId){
        $db = Database::instance()->db();

        $commentsForStory = $db->prepare('SELECT id, text, parent_comment, username, published, points, text FROM Comment WHERE story_id = ?');
            
        $commentsForStory->execute(array($storyId));
        $commentsForStory = $commentsForStory->fetchAll();

        return $commentsForStory;
    }

?>