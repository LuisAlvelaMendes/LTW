<?php
	include_once('../database/db_story.php');

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

  // Add a time field to each message
  foreach ($messages as $index => $message) {
    $time = date('h:i:s', $message['date']);
    $messages[$index]['time'] = $time;
  }

  // JSON encode
  echo json_encode($messages);
?>
