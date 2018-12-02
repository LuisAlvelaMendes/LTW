<?php

include_once('../includes/session.php');
include_once('../database/db_story.php');

$story = $_POST['story'];
$username = $_POST['username'];
$voteType = $_POST['type'];

/* TODO: will be the same as story once story is working */

header("Location: ../pages/homepage.php");

?>