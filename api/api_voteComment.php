<?php
	include_once('../database/db_comments.php');

	if(isset($_POST['CBs']) && isset($_POST['username'])) {
		$commentIds = $_POST['CBs'];
		$username = $_POST['username'];

		$usrVotes = array();
		$j = 0;
	
		$ids = explode(',', $commentIds);

		for ($i = 0; $i < sizeof($ids); $i++) { 
			if($ids[$i] != ','){
				$vote = comment_getUserVotes($ids[$i], $username);
				
				if(!empty($vote)) {
					$usrVotes[$j] = array('id' => $ids[$i], 'type' => $vote[0]['type']);
					$j++;
				}
			}
		}

		echo json_encode($usrVotes);
			
	} else if(isset($_POST['id']) && isset($_POST['username']) && isset($_POST['point'])){
			$commentId = $_POST['id'];
			$username = $_POST['username'];
			$voteType = $_POST['point'];

			$vote = comment_addVote($commentId, $username, $voteType);
			$points = comment_getCommentPoints($commentId);

			if(empty($vote)){
				$ret=array('id' => $commentId, 'type' => null, 'points' => $points[0]);
			} else {
				$ret=array('id' => $commentId, 'type' => $vote[0]['type'], 'points' => $points[0]);
			}

			echo json_encode($ret);
	}
?>