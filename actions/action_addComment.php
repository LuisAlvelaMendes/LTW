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
  foreach ($messages as $message) {
    $message['text'] = draw_references($message['text']);
  }

  // JSON encode
  echo json_encode($messages);
?>
