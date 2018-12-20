<?php 
    include_once('../includes/session.php');
    
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_profile.php');

    include_once('../database/db_user.php');

    $usernameOfProfile = $_GET['name'];  

    if(!isset($_SESSION['username'])) {
        draw_header(null, 'Homepage',$usernameOfProfile);
    } else {
        draw_header($_SESSION['username'], 'Homepage', $usernameOfProfile);

        if($usernameOfProfile == $_SESSION['username']){
            draw_edit_profile_button();
        }
    }

    draw_errorMessages();

    $userInfo = getUserPublicInfo($usernameOfProfile);
    
    draw_user_info($usernameOfProfile, $userInfo[0]['created'], $userInfo[0]['points'], $userInfo[0]['email']);

    draw_subscribedChannels($usernameOfProfile);
    
    draw_posted_stories($usernameOfProfile);
    
    draw_posted_comments($usernameOfProfile);

    draw_footer();
?> 