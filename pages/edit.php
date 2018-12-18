<?php
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_profile.php');

    if(!isset($_SESSION['username'])) {
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'You do not have permission to access that page!');
        die(header('Location: homepage.php'));
    } else {
        draw_header($_SESSION['username'], 'Homepage', $_SESSION['username']);
    }
    
    draw_edit_profile();

    draw_footer();
?>