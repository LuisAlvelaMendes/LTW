<?php include_once('tpl_subList.php') ?>

<?php function draw_header($username, $channel_name) { ?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>Lorem ipsum dolor sit amet</title>
			<meta charset="utf-8" />
			<link rel="stylesheet" href="../css/common.css">
		</head>

	<body>
		<header>
			<h1><?=$channel_name?></h1>
		<?php if($username != NULL) { ?>
			<nav id="signup">
				<a href=""><?= $username ?></li></a>	<!-- SE O USER CLICAR NO NOME VAI AO SEU PROFILE -->
				<a href="../actions/action_logout.php">Logout</a>
				<?php draw_subscriberList() ?>
			</nav>
		<? } else { ?>
			<nav id="signup">
				<a href="../pages/login.php">Login</a>
				<a href="../pages/register.php">Register</a>
			</nav>
			<? } ?>
			</header>
<?php } ?>

<?php function draw_story_text($story_title, $fulltext) { ?>
		<section>
			<h1><?=$story_title?></h1>
			<p><?=$fulltext?></p>
		</section>
<?php } ?>


<?php function convert_epoch($epoch) {
	$dt = new DateTime("@$epoch");
	return $dt;
}
?>

<?php function draw_info_bar($username, $channel, $data) { ?>
	<section id = "info_bar">
		<input type="radio" name="point" value="1">UP
		<input type="radio" name="point" value="-1">DOWN
		<div>
			<?php $data = convert_epoch($data) ?>
			<h6 id="date"><?=$data->format('Y-m-d')?></h6>
			<a id="channel" href=""><?=$channel?></a>
		</div>
		<a id="profile" href=""><?=$username?></a>
	</section>
<?php } ?>


<?php function draw_comments_section($comments, $channel) { ?>
	
	<h3> Comment Section: </h3>
	
	<section id = "comments">
		<? for($i=0; $i < sizeof($comments); $i++) { ?>
			<div>
				<p><?=$comments[$i]['text']?><p>
				
				<div>
					<?php draw_info_bar($comments[$i]['username'], $channel, $comments[$i]['published']); ?>
				</div>
			</div>
		<? } ?>
	</section>
<?php } ?>



<?php function draw_footer() { ?>
	</body>
	<footer> 
		<p>&copy; TRABALHO LTW LUÍS, RICARDO, SIMÃO</p>	<!-- FALTA DECIDIR O QUE METER NO FOOTER-->
	</footer>
	</html>
<?php } ?>