<?php
    include_once('../includes/session.php');
    include_once('../database/db_comments.php');

    $story = $_POST['story'];
    $comment = $_POST['comment'];
    $username = $_POST['username'];
    $voteType = $_POST['type'];

    if (!checkIfCommentWasVotedOnByUser($comment, $username, $voteType)) {
        voteComment($comment, $voteType);
        header("Location: ../pages/story.php?id=$story");
    }

if(!checkIfCommentWasVotedOnByUser($comment, $username, $voteType)){
    header("Location: ../pages/story.php?id=$story");
?>