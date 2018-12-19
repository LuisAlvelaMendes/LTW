<?php
  include_once('../database/db_comments.php');
  include_once('../templates/tpl_common.php');

  // Current time
  $timestamp = time();

  // Get last_id
	$story_id = $_GET['story_id'];

  if (isset($_GET['text'])) {
    // GET username and text
    $username = $_GET['username'];
    $text = $_GET['text'];

    $text = htmlspecialchars($text);

		addComment($story_id, $username, $timestamp, $text);
  }

  // Retrieve new comments
  $comments = getNewComments($story_id);

  $commentsFix = array();

  // alter text field of each message
  for($i = 0; $i < sizeof($comments); $i++) {
	$text = draw_references($comments[$i]['text']);
	$date = time_elapsed('@' . $comments[$i]['date']);
	$commentsFix[$i] = array('text' => $text, 'storyId' => $comments[$i]['story_id'], 
							'commentId' => $comments[$i]['id'], 'author' => $comments[$i]['username'], 
							'username' => $comments[$i]['username'], 'date' => $date,
							'points' => $comments[$i]['points']);
	
  }

  // JSON encode
  echo json_encode($commentsFix);
?>
