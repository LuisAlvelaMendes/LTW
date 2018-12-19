<?php 
    include_once('../templates/tpl_common.php');
    include_once('../includes/database.php');

    $order = $_GET['order'];
    $channel = $_GET['channel'];

    switch ($order) {
        case "Date":
            $stories = getStoriesByDate($channel);
            break;
        case "Comments":
            $stories = getStoriesByComments($channel);
            break;
        case "Points":
            $stories = getStoriesByPoints($channel);
            break;
    }

    $storiesFix = array();

    for($i = 0; $i < sizeof($stories); $i++) {
        $date = time_elapsed('@' . $stories[$i]['published']);
        $storiesFix[$i] = array('fulltext' => $stories[$i]['fulltext'], 'storyId' => $stories[$i]['id'], 
                                'title' => $stories[$i]['title'], 'author' => $stories[$i]['author'], 
                                'published' => $date, 'points' => $stories[$i]['points']);
    }

	echo json_encode($storiesFix);
?>

<?php function getStoriesByDate($channel){
    $db = Database::instance()->db();

	$storiesFromChannel = $db->prepare('SELECT * FROM Story WHERE channel = ? ORDER BY published DESC');
	$storiesFromChannel->execute(array($channel));
	return $storiesFromChannel->fetchAll();
} ?>

<?php function getStoriesByComments($channel) {
    $db = Database::instance()->db();

    $storiesFromChannel = $db->prepare('SELECT * FROM(
                                        SELECT Story.id as id, Story.title as title, Story.published as published, Story.channel as channel, Story.author as author, Story.points as points, Story.fulltext as fulltext, count(*) as nComment FROM Story,Comment WHERE Story.id = story_id AND channel = :channel GROUP BY story_id  
                                        UNION
                                        SELECT Story.id as id, Story.title as title, Story.published as published, Story.channel as channel, Story.author as author, Story.points as points, Story.fulltext as fulltext, 0        as nComment FROM Story WHERE channel = :channel AND id NOT IN (SELECT story_id FROM Comment)) ORDER BY nComment DESC');

    $storiesFromChannel->bindParam(':channel', $channel);
    $storiesFromChannel->execute();
   return $storiesFromChannel->fetchAll();
} ?>

<?php function getStoriesByPoints($channel) {
    $db = Database::instance()->db();

	$storiesFromChannel = $db->prepare('SELECT * FROM Story WHERE channel = ? ORDER BY points DESC');	
	$storiesFromChannel->execute(array($channel));
	return $storiesFromChannel->fetchAll();
}?>