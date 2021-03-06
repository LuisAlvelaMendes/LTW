<?php
	include_once('../database/db_story.php');

	// Gets user vote on stories
	if(isset($_POST['CBs']) && isset($_POST['username'])) {
		$storyIds = $_POST['CBs'];
		$username = $_POST['username'];

		$usrVotes = array();
		$j = 0;
	
		$ids = explode(',', $storyIds);

		for ($i = 0; $i < sizeof($ids); $i++) { 
			if($ids[$i] != ','){
				$vote = getUserVotes($ids[$i], $username);

				if(!empty($vote)) {
					$usrVotes[$j] = array('id' => $ids[$i], 'type' => $vote[0]['type']);
					$j++;
				}
			}
		}

		echo json_encode($usrVotes);
		
	// Changes/Adds user votes on story
	} else if(isset($_POST['id']) && isset($_POST['username']) && isset($_POST['point'])){
			$storyId = $_POST['id'];
			$username = $_POST['username'];
			$voteType = $_POST['point'];

			$vote = addVote($storyId, $username, $voteType);
			$points = getStoryPoints($storyId);

			if(empty($vote)){
				$ret=array('id' => $storyId, 'type' => null, 'points' => $points[0]);
			} else {
				$ret=array('id' => $storyId, 'type' => $vote[0]['type'], 'points' => $points[0]);
			}

			echo json_encode($ret);
	}
?>