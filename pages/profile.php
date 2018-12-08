<?php 
    include_once('../includes/session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_sub.php');
    include_once('../database/db_user.php');
    include_once('../templates/tpl_profile.php');

    $usernameOfProfile = $_GET['name'];  

    if(!isset($_SESSION['username'])) {
        draw_header(null, 'NOT REDDIT');
    } else {
        draw_header($_SESSION['username'], 'NOT REDDIT');

        if($usernameOfProfile == $_SESSION['username']){
            draw_edit_profile_button();
        }
    }

    $userInfo = getUserPublicInfo($usernameOfProfile);

    draw_subscribersAside($usernameOfProfile);
    
    draw_posted_stories($usernameOfProfile);
    
    draw_posted_comments($usernameOfProfile);

    draw_user_info($usernameOfProfile, $userInfo[0]['created'], $userInfo[0]['points']);

    draw_footer();
?> 