<?php
    include_once('../includes/session.php');

	include_once('../templates/tpl_search.php');
	include_once('../templates/tpl_common.php');

    
	if(!isset($_SESSION['username'])) {
		draw_header(null, 'NOT REDDIT');

	} else {
		draw_header($_SESSION['username'], 'NOT REDDIT');
    }	
    
    draw_searchbar();

    draw_footer();

?>