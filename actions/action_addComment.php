<?php
  include_once('../database/db_story.php');
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

  // Retrieve new messages
  $messages = getNewComments($story_id);

  // alter text field of each message
  for($i = 0; $i < sizeof($messages); $i++) {
    $messages[$i]['text'] = draw_references($messages[$i]['text']);
  }

  // JSON encode
  echo json_encode($messages);
?>
