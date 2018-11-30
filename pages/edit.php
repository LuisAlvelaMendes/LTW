<?php
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_profile.php');

    if(!isset($_SESSION['username'])) {
        draw_header(null, 'NOT REDDIT');
    } else {
        draw_header($_SESSION['username'], 'NOT REDDIT');
    }
    
    draw_edit_profile();

    draw_footer();
?>