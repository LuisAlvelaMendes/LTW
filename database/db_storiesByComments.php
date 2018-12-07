<?php

    include_once('../includes/database.php');

    $channel = $_GET['channel'];

    $db = Database::instance()->db();

    $storiesFromChannel = $db->prepare('SELECT * FROM(
                                        SELECT Story.id as id, Story.title as title, Story.published as published, Story.channel as channel, Story.author as author, Story.points as points, Story.fulltext as fulltext, count(*) as nComment FROM Story,Comment WHERE Story.id = story_id AND channel = :channel GROUP BY story_id  
                                        UNION
                                        SELECT Story.id as id, Story.title as title, Story.published as published, Story.channel as channel, Story.author as author, Story.points as points, Story.fulltext as fulltext, 0        as nComment FROM Story WHERE channel = :channel AND id NOT IN (SELECT story_id FROM Comment)) ORDER BY nComment DESC');

    $storiesFromChannel->bindParam(':channel', $channel);
    $storiesFromChannel->execute();
    $stories = $storiesFromChannel->fetchAll();

	echo json_encode($stories);
?>