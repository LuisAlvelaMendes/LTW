<?php
    include_once('../includes/database.php');

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

	function comment_getUserVotes($commentId, $username) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('SELECT type FROM CommentVote WHERE comment_id = ? AND username = ?');
		$stmt->execute(array($commentId, $username));
		$vote = $stmt->fetchAll();

		return $vote;
	}

	function comment_addVote($commentId, $username, $voteType) { 
		$db = Database::instance()->db();
		$stmt = $db->prepare('SELECT type FROM CommentVote WHERE comment_id = ? AND username = ?');
		$stmt->execute(array($commentId, $username));

		$currentType = $stmt->fetchAll();
		
		if(empty($currentType)){
			comment_addUserVote($username, $commentId, $voteType);
		} else {
			if($currentType[0]['type'] == $voteType) {
				comment_removeUserVote($commentId, $username);
			} else if($currentType[0]['type'] != $voteType){
				comment_swapUserVote($commentId, $username, $voteType);
			}
		}

		return $currentType;
	}

	function comment_addUserVote($username, $commentId, $voteType) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('INSERT INTO CommentVote VALUES(?, ?, ?)');
		$stmt->execute(array($username, $commentId, $voteType));
	}

	function comment_removeUserVote($commentId, $username) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('DELETE FROM CommentVote WHERE comment_id = ? AND username = ?');
		$stmt->execute(array($commentId, $username));
	}

	function comment_swapUserVote($commentId, $username, $voteType) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('DELETE FROM CommentVote WHERE comment_id = ? AND username = ?');
		$stmt->execute(array($commentId, $username));

		$stmt = $db->prepare('INSERT INTO CommentVote VALUES(?, ?, ?)');
		$stmt->execute(array($username, $commentId, $voteType));
	}

	function comment_getCommentPoints($commentId){
		$db = Database::instance()->db();
		$stmt = $db->prepare('SELECT points FROM Comment WHERE id = ?');
		$stmt->execute(array($commentId));

		return $stmt->fetchAll();
	}
?>