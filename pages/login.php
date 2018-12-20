<?php
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_auth.php');

	draw_header(null, 'Homepage', 'Login');

	draw_errorMessages();

	draw_login();

	draw_footer();
?>