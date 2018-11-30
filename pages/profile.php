<?php 
    include_once('../includes/session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_sub.php');
    include_once('../database/db_user.php');

    if(!isset($_SESSION['username'])) {
        draw_header(null, 'NOT REDDIT');
    } else {
        draw_header($_SESSION['username'], 'NOT REDDIT');
    }

    $usernameOfProfile = $_GET['name'];
    $userInfo = getUserPublicInfo($usernameOfProfile);

    draw_subscribersAside($usernameOfProfile);

    draw_user_info($usernameOfProfile, $userInfo[0]['created'], $userInfo[0]['points']);

    draw_footer();
?> 