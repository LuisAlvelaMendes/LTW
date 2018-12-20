<?php
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_auth.php');

	draw_header(null, 'Homepage', 'Register');

	draw_errorMessages();

	draw_register();

	draw_footer();
?>