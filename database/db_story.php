<?php
	include_once('../includes/database.php');

	function getStoriesFromChannelByDate($channel) {
		$db = Database::instance()->db();

		$storiesFromChannel = $db->prepare('SELECT * FROM Story WHERE channel = ? ORDER BY published DESC');
				
		$storiesFromChannel->execute(array($channel));
		$storiesFromChannel = $storiesFromChannel->fetchAll();

		return $storiesFromChannel;
	}

	function getStoriesFromChannelByPoints($channel) {
		$db = Database::instance()->db();

		$storiesFromChannel = $db->prepare('SELECT * FROM Story WHERE channel = ? ORDER BY points DESC');
				
		$storiesFromChannel->execute(array($channel));
		$storiesFromChannel = $storiesFromChannel->fetchAll();

		return $storiesFromChannel;
	}

	function getStoriesfromChannelByComments($channel) {
		$db = Database::instance()->db();

		$storiesFromChannel = $db->prepare('SELECT * FROM(
											SELECT Story.id as id, Story.title as title, Story.published as published, Story.channel as channel, Story.author as author, Story.points as points, Story.fulltext as fulltext, count(*) as nComment FROM Story,Comment WHERE Story.id = story_id AND channel = :channel GROUP BY story_id  
											UNION
											SELECT Story.id as id, Story.title as title, Story.published as published, Story.channel as channel, Story.author as author, Story.points as points, Story.fulltext as fulltext, 0        as nComment FROM Story WHERE channel = :channel AND id NOT IN (SELECT story_id FROM Comment)) ORDER BY nComment DESC');

		$storiesFromChannel->bindParam(':channel', $channel);
		$storiesFromChannel->execute();
		$storiesFromChannel = $storiesFromChannel->fetchAll();

		return $storiesFromChannel;

	}

	function getMostRecentStoryFromChannel($channel) {
		$db = Database::instance()->db();

		$recentStory = $db->prepare('SELECT id, title, fulltext, MAX(published) AS "published", channel, author, points FROM Story  WHERE channel = ?');
				
		$recentStory->execute(array($channel));
		$recentStory = $recentStory->fetchAll();

		return $recentStory;
	}

	function getStoryMainInfoById($storyId) {
		$db = Database::instance()->db();

		$correspondingStory = $db->prepare('SELECT channel, title, fulltext, published, author, points FROM Story WHERE id = ?');
				
		$correspondingStory->execute(array($storyId));
		$correspondingStory = $correspondingStory->fetchAll();

		return $correspondingStory;
	}

	function addComment($story_id, $username, $timestamp, $text) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('INSERT INTO comment (story_id, parent_comment, username, date, text) VALUES (?, null, ?, ?, ?)');
  		$stmt->execute(array($story_id, $username, $timestamp, $text));
	}

	function getNewComments($story_id) {
		$db = Database::instance()->db();
		$stmt = $db->prepare("SELECT * FROM Comment WHERE story_id = ? ORDER BY date DESC");
		$stmt->execute(array($story_id));
		$comments = $stmt->fetchAll();

		return $comments;
	}

	//will return false if it wasn't, or it was but with the opposite type of vote
	function checkIfStoryWasVotedOnByUser($storyId, $username, $voteType) { 
		$db = Database::instance()->db();

		$stmt = $db->prepare('SELECT type FROM StoryVote WHERE story_id = ? AND username = ?');
		$stmt->execute(array($storyId, $username));

		$currentlySavedType = $stmt->fetchAll();

		if(empty($currentlySavedType)){
			addUsersVote($username, $storyId, $voteType);
			return false;
		}

		else {
			if($currentlySavedType[0]['type'] == $voteType){
				return true;
			}

			if($currentlySavedType[0]['type'] != $voteType){
				changeUsersVote($storyId, $username);
				return false;
			}
		}
	}

	//will return false if it wasn't, or it was but with the opposite type of vote
	function checkIfStoryVoteDisplay($storyId, $username, $voteType) { 
		$db = Database::instance()->db();

		$stmt = $db->prepare('SELECT type FROM StoryVote WHERE story_id = ? AND username = ?');
		$stmt->execute(array($storyId, $username));

		$currentlySavedType = $stmt->fetchAll();

		if(empty($currentlySavedType)){
			return false;
		}

		else {
			if($currentlySavedType[0]['type'] == $voteType){
				return true;
			}

			if($currentlySavedType[0]['type'] != $voteType){
				return false;
			}
		}
	}

	function changeUsersVote($storyId, $username) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('DELETE FROM StoryVote WHERE story_id = ? AND username = ?');
		$stmt->execute(array($storyId, $username));
	}

	function addUsersVote($username, $storyId, $voteType) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('INSERT INTO StoryVote VALUES(?, ?, ?)');
		$stmt->execute(array($username, $storyId, $voteType));
	}
	
?>