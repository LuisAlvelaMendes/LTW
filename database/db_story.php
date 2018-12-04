<?php
	include_once('../includes/database.php');

	function getStoriesFromChannel($channel){
		$db = Database::instance()->db();

		$storiesFromChannel = $db->prepare('SELECT id, title, fulltext, published, channel, author, points FROM Story WHERE channel = ?');
				
		$storiesFromChannel->execute(array($channel));
		$storiesFromChannel = $storiesFromChannel->fetchAll();

		return $storiesFromChannel;
	}

	function getMostRecentStoryFromChannel($channel){
		$db = Database::instance()->db();

		$recentStory = $db->prepare('SELECT id, title, fulltext, MAX(published) AS "published", channel, author, points FROM Story  WHERE channel = ?');
				
		$recentStory->execute(array($channel));
		$recentStory = $recentStory->fetchAll();

		return $recentStory;
	}

	function getStoryMainInfoById($storyId){
		$db = Database::instance()->db();

		$correspondingStory = $db->prepare('SELECT channel, title, fulltext, published, author, points FROM Story WHERE id = ?');
				
		$correspondingStory->execute(array($storyId));
		$correspondingStory = $correspondingStory->fetchAll();

		return $correspondingStory;
	}

	function addComment($storyId, $text){
		$db = Database::instance()->db();
		$stmt = $db->prepare('INSERT INTO comment (story_id, parent_comment, username, published, text) VALUES (?, null, ?, ?, ?)');
		$stmt->execute(array($storyId, $_SESSION['username'], time(), $text));
	}

	function checkIfStoryWasVotedOnByUser($storyId, $username, $voteType){ //will return false if it wasn't, or it was but with the opposite type of vote
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

	function changeUsersVote($storyId, $username){
		$db = Database::instance()->db();
		$stmt = $db->prepare('DELETE FROM StoryVote WHERE story_id = ? AND username = ?');
		$stmt->execute(array($storyId, $username));
	}

	function addUsersVote($username, $storyId, $voteType){
		$db = Database::instance()->db();
		$stmt = $db->prepare('INSERT INTO StoryVote VALUES(?, ?, ?)');
		$stmt->execute(array($username, $storyId, $voteType));
	}

	function voteStory($storyId, $type){

		$db = Database::instance()->db();

		if($type == "1"){
			$stmt = $db->prepare('UPDATE Story SET points = points + 1 WHERE id = ?');
			$stmt->execute(array($storyId));
		}

		if($type == "0"){
			$stmt = $db->prepare('UPDATE Story SET points = points - 1 WHERE id = ?');
			$stmt->execute(array($storyId));
		}
	}

?>