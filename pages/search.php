<?php
    include_once('../includes/session.php');

	include_once('../templates/tpl_search.php');
	include_once('../templates/tpl_common.php');

    
	if(!isset($_SESSION['username'])) {
		draw_header(null, 'Homepage', 'Search');

	} else {
		draw_header($_SESSION['username'], 'Homepage', 'Search');
    }	
	
	draw_errorMessages();

    draw_searchbar();

    draw_footer();
?>