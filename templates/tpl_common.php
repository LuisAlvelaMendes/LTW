<?php include_once('tpl_sub.php') ?>

<?php function draw_header($username, $channel) { ?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>Lorem ipsum dolor sit amet</title>
			<meta charset="utf-8" />
			<link rel="stylesheet" href="../css/common.css">
		</head>

		<body>
			<header>
				<?php if($channel === "NOT REDDIT") { ?>
					<h1><?=$channel?></h1>
				<?php } else { ?>
					<h1 id="channel" onclick="window.location.href='../pages/channel.php?name=<?=$channel?>'"><?=$channel?></h1>
				<?php } ?>

				<?php if($username != NULL) { ?>
					<nav id="signup">
						<a href=""><?= $username ?></li></a>	<!-- SE O USER CLICAR NO NOME VAI AO SEU PROFILE -->
						<a href="../actions/action_logout.php">Logout</a>
						<?php draw_subscriberList() ?>
					</nav>
				<?php } else { ?>
					<nav id="signup">
						<a href="../pages/login.php">Login</a>
						<a href="../pages/register.php">Register</a>
					</nav>
				<?php } ?>
			</header>
<?php } ?>

<?php function draw_story_text($story_title, $fulltext) { ?>
	<link rel="stylesheet" href="../css/story.css">

	<section id="storyText">
		<h1><?=$story_title?></h1>
		<p><?=$fulltext?></p>
	</section>

<?php } ?>

<?php function convert_epoch($epoch) {
	$dt = new DateTime("@$epoch");
	return $dt;
} ?>

<?php function draw_info_bar($username, $channel, $data) { ?>
	<section id = "info_bar">
		<div id="start">
			<img src="https://dummyimage.com/20x20/524f52/d12222&text=ʌ" alt="upvote">
			<img src="https://dummyimage.com/20x20/524f52/d12222&text=v" alt="downvote">
		</div>
		
		<div id="middle">
			<?php $data = convert_epoch($data) ?>
			<h6 id="date"><?=$data->format('Y-m-d')?></h6>
			<a id="channel" onclick="window.location.href='../pages/channel.php?name=<?=$channel?>'"><?=$channel?></a>
		</div>

		<div id="end">
			<a id="profile" onclick="window.location.href='../pages/profile.php?name=<?=$username?>'"><?=$username?></a>
		</div>
	</section>
<?php } ?>

<?php function draw_comments_section($comments, $channel) { ?>
	<link rel="stylesheet" href="../css/story.css">

	<h3 id="comments"> Comment Section: </h3>
	
	<section>
		<?php for($i=0; $i < sizeof($comments); $i++) { ?>
				<p id="usrComment"><?=$comments[$i]['text']?></p>
				<?php draw_info_bar($comments[$i]['username'], $channel, $comments[$i]['published']); ?>
		<?php } ?>
	</section>
<?php } ?>

<?php function draw_footer() { ?>
	</body>
	<footer> 
		<p>&copy; TRABALHO LTW LUÍS, RICARDO, SIMÃO</p>	<!-- FALTA DECIDIR O QUE METER NO FOOTER-->
	</footer>
	</html>
<?php } ?>