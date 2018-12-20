<?php
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_auth.php');

	// Verify if user is logged in
	if (isset($_SESSION['username']))
	{
		$_SESSION['messages'][] = array('type' => 'error', 'content' => 'You do not have permission to access that page!');
		die(header('Location: homepage.php'));
	}

	draw_header(null, 'Homepage', 'Register');

	draw_errorMessages();

	draw_register();

	draw_footer();
?>