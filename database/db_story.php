<?php
	include_once('../includes/database.php');

	function getStoriesFromChannel($channel) {
		$db = Database::instance()->db();

		$storiesFromChannel = $db->prepare('SELECT * FROM Story WHERE channel = ? ORDER BY published DESC');
				
		$storiesFromChannel->execute(array($channel));
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

	function getStoriesFromSubscribedChannels($username) {
		$db = Database::instance()->db();
		
		$stories = $db->prepare('SELECT * FROM Story WHERE channel in (SELECT channel FROM userSubscriptions WHERE username = ?) ORDER BY published DESC');

		$stories->execute(array($username));
		$stories = $stories->fetchAll();

		return $stories;
	}

	function getStoryMainInfoById($storyId) {
		$db = Database::instance()->db();

		$correspondingStory = $db->prepare('SELECT * FROM Story WHERE id = ?');
				
		$correspondingStory->execute(array($storyId));
		return $correspondingStory->fetchAll();
	}

	function getUserVotes($storyId, $username) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('SELECT type FROM StoryVote WHERE story_id = ? AND username = ?');
		$stmt->execute(array($storyId, $username));
		$vote = $stmt->fetchAll();

		return $vote;
	}

	function addVote($storyId, $username, $voteType) { 
		$db = Database::instance()->db();
		$stmt = $db->prepare('SELECT type FROM StoryVote WHERE story_id = ? AND username = ?');
		$stmt->execute(array($storyId, $username));

		$currentType = $stmt->fetchAll();
		
		if(empty($currentType)){
			addUsersVote($username, $storyId, $voteType);
		} else {
			if($currentType[0]['type'] == $voteType) {
				removeUserVote($storyId, $username);
			} else if($currentType[0]['type'] != $voteType){
				swapUsersVote($storyId, $username, $voteType);
			}
		}

		return $currentType;
	}

	function addUsersVote($username, $storyId, $voteType) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('INSERT INTO StoryVote VALUES(?, ?, ?)');
		$stmt->execute(array($username, $storyId, $voteType));
	}

	function removeUserVote($storyId, $username) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('DELETE FROM StoryVote WHERE story_id = ? AND username = ?');
		$stmt->execute(array($storyId, $username));
	}

	function swapUsersVote($storyId, $username, $voteType) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('DELETE FROM StoryVote WHERE story_id = ? AND username = ?');
		$stmt->execute(array($storyId, $username));

		$stmt = $db->prepare('INSERT INTO StoryVote VALUES(?, ?, ?)');
		$stmt->execute(array($username, $storyId, $voteType));
	}

	function getStoryPoints($storyId){
		$db = Database::instance()->db();
		$stmt = $db->prepare('SELECT points FROM Story WHERE id = ?');
		$stmt->execute(array($storyId));

		return $stmt->fetchAll();
	}
	
?>