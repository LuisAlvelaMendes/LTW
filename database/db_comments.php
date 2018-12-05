<?php
    include_once('../includes/database.php');

    function getCommentsFromStory($storyId){
        $db = Database::instance()->db();

        $commentsForStory = $db->prepare('SELECT id, text, parent_comment, username, date, points, text FROM Comment WHERE story_id = ?');
            
        $commentsForStory->execute(array($storyId));
        $commentsForStory = $commentsForStory->fetchAll();

        return $commentsForStory;
    }

    function checkIfCommentWasVotedOnByUser($commentId, $username, $voteType){ //will return false if it wasn't, or it was but with the opposite type of vote
		$db = Database::instance()->db();

		$stmt = $db->prepare('SELECT type FROM CommentVote WHERE comment_id = ? AND username = ?');
		$stmt->execute(array($commentId, $username));

		$currentlySavedType = $stmt->fetchAll();

		if(empty($currentlySavedType)){
			addUsersVoteComment($username, $commentId, $voteType);
			return false;
		}

		else {
			if($currentlySavedType[0]['type'] == $voteType){
				return true;
			}

			if($currentlySavedType[0]['type'] != $voteType){
				changeUsersVoteComment($commentId, $username);
				return false;
			}
		}
	}

	function changeUsersVoteComment($commentId, $username){
		$db = Database::instance()->db();
		$stmt = $db->prepare('DELETE FROM CommentVote WHERE comment_id = ? AND username = ?');
		$stmt->execute(array($commentId, $username));
    }
    
    function addUsersVoteComment($username, $commentId, $voteType){
		$db = Database::instance()->db();
		$stmt = $db->prepare('INSERT INTO CommentVote VALUES(?, ?, ?)');
		$stmt->execute(array($username, $commentId, $voteType));
	}

	function voteComment($commentId, $type){

		$db = Database::instance()->db();

		if($type == "1"){
			$stmt = $db->prepare('UPDATE Comment SET points = points + 1 WHERE id = ?');
			$stmt->execute(array($commentId));
		}

		if($type == "0"){
			$stmt = $db->prepare('UPDATE Comment SET points = points - 1 WHERE id = ?');
			$stmt->execute(array($commentId));
		}
	}

?>