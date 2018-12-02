<?php

include_once('../includes/session.php');
include_once('../database/db_story.php');

$story = $_POST['story'];
$username = $_POST['username'];
$voteType = $_POST['type'];

if(!checkIfStoryWasVotedOnByUser($story, $username, $voteType)){
    voteStory($story, $voteType);
    header("Location: ../pages/story.php?id=$story");
}

?>