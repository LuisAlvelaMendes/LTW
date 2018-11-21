<?php 
    include_once('../includes/session.php');
    include_once('../templates/tpl_common.php');
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Lorem ipsum dolor sit amet</title>
        <link rel="stylesheet" href="../css/top_subs.css">
        <meta charset="utf-8">
    </head>

   <?php if(!isset($_SESSION['username'])) {
		draw_header(null, 'NOT REDDIT');
	} else {
		draw_header($_SESSION['username'], 'NOT REDDIT');
	} ?>
    
    <?php draw_footer() ?>
</html>