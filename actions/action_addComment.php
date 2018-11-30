<?php

include_once('../includes/session.php');
include_once('../database/db_story.php');

$story = $_POST['story'];
$text = $_POST['text'];

addComment($story, $text);
header("Location: ../pages/story.php?id=$story");


?>