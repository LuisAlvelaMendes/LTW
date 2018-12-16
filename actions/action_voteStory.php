<?php
	include_once('../database/db_story.php');

	if(isset($_POST['CBs']) && isset($_POST['username'])) {
		$storyIds = $_POST['CBs'];
		$username = $_POST['username'];

		$usrVotes = array();
		$j = 0;
	
		for ($i = 0; $i < strlen($storyIds); $i++) { 
			if($storyIds[$i] != ','){
				$vote = getUserVotes($storyIds[$i], $username);

				if(!empty($vote)) {
					$usrVotes[$j] = array('id' => $storyIds[$i], 'type' => $vote[0]['type']);
					$j++;
				}
			}
		}

		echo json_encode($usrVotes);
			
	} else if(isset($_POST['id']) && isset($_POST['username']) && isset($_POST['point'])){
			$storyId = $_POST['id'];
			$username = $_POST['username'];
			$voteType = $_POST['point'];

			$vote = addVote($storyId, $username, $voteType);
			$points = getStoryPoints($storyId);

			if(empty($vote)){
				$ret=array('id' => $storyId, 'type' => null, 'points' => $points);
			} else {
				$ret=array('id' => $storyId, 'type' => $vote[0]['type'], 'points' => $points);
			}

			echo json_encode($ret);
	}
?>