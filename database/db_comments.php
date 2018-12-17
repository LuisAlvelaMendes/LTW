<?php
    include_once('../includes/database.php');

    function getCommentsFromStory($storyId) {
        $db = Database::instance()->db();

        $commentsForStory = $db->prepare('SELECT id, text, parent_comment, username, date, points, text FROM Comment WHERE story_id = ?');
            
        $commentsForStory->execute(array($storyId));
        $commentsForStory = $commentsForStory->fetchAll();

        return $commentsForStory;
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
			comment_addUsersVote($username, $commentId, $voteType);
		} else {
			if($currentType[0]['type'] == $voteType) {
				comment_removeUserVote($commentId, $username);
			} else if($currentType[0]['type'] != $voteType){
				comment_swapUsersVote($commentId, $username, $voteType);
			}
		}

		return $currentType;
	}

	function comment_addUsersVote($username, $commentId, $voteType) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('INSERT INTO CommentVote VALUES(?, ?, ?)');
		$stmt->execute(array($username, $commentId, $voteType));
	}

	function comment_removeUserVote($commentId, $username) {
		$db = Database::instance()->db();
		$stmt = $db->prepare('DELETE FROM CommentVote WHERE comment_id = ? AND username = ?');
		$stmt->execute(array($commentId, $username));
	}

	function comment_swapUsersVote($commentId, $username, $voteType) {
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