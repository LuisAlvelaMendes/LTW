<?php 
	include_once('tpl_sub.php');
	include_once('tpl_story.php');
?>

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
					<a id="title" href="../pages/homepage.php"><?=$channel?></a>
				<?php } else { ?>
					<a id="title" href="../pages/channel.php?name=<?=$channel?>"><?=$channel?></a>
				<?php } ?>

				<?php if($username != NULL) { ?>
					<nav id="signup">
						<a id="profile" href="../pages/profile.php?name=<?=$username?>"><?= $username ?></a>
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

			<?php if(isset($_SESSION['messages'])) { ?>
				<section id="messages">
					<?php foreach ($_SESSION['messages'] as $message) { ?>
						<div class="<?=$message['type']?>"><?=$message['content']?></div>
					<?php } ?>
				</section>
				<?php unset($_SESSION['messages']); 
			} ?>
<?php } ?>

<?php function draw_story_text($story_title, $fulltext) { ?>
	<link rel="stylesheet" href="../css/story.css">

	<section id="storyText">
		<h1><?=htmlspecialchars($story_title)?></h1>
		<p><?=htmlspecialchars($fulltext)?></p>
	</section>

<?php } ?>

<?php function draw_user_info($username, $created, $points) { ?>
	<?php $data = convert_epoch($created) ?>
	
	<link rel="stylesheet" href="../css/story.css">

	<section id="storyText">
		<h1>The user is: <?=$username?></h1>
		<p>Account created in: <?=$data->format('Y-m-d')?></p>
		<p>Points: <?=$points?></p>
	</section>

<?php } ?>

<?php function convert_epoch($epoch){
	$dt = new DateTime("@$epoch");
	return $dt;
} ?>

<?php function time_elapsed($date) {
	$now = new DateTime;
	$ago = new DateTime($date);

	$diff = $now->diff($ago);
	$diff->w = floor($diff->d / 7);

	$diff->d -= $diff->w * 7;
	$string = array(
		'y' => 'y',
		'm' => 'm',
		'w' => 'w',
		'd' => 'd',
		'h' => 'h',
		'i' => 'min',
		's' => 's',
	);

	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v;
		} else {
			unset($string[$k]);
		}
	}

	$string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . '' : 'just now';
} ?>

<?php function draw_createChannel() { ?>
	<link rel="stylesheet" href="../css/channel.css">
	<form action='../actions/action_createChannel.php' method='post'>
		<input id="createChannelText" type='text' placeholder='Enter the channel name' name='name' required>
		<button id="createChannelButton" type='submit'>Create Channel</button>
	</form>
<?php } ?>

<?php function draw_subscribeButton($channel) { ?>
	<link rel="stylesheet" href="../css/common.css">
	<form action='../actions/action_subscribeChannel.php' method='post'>

		<input type="hidden" name="channel" value="<?=$channel?>">

		<button id = "subscribe" class = "button" type='submit'>Subscribe</button>
	</form>
<?php } ?>

<?php function draw_unsubscribeButton($channel) { ?>
	<link rel="stylesheet" href="../css/common.css">
	<form action='../actions/action_unsubscribeChannel.php' method='post'>

		<input type="hidden" name="channel" value="<?=$channel?>">

		<button id = "unsubscribe" class = "button" type='submit'>Unsubscribe</button>
	</form>
<?php } ?>

<?php function draw_info_bar_story($storyId, $username, $channel, $date, $points) { ?>
	<section id = "info_bar">
		<div id="start">

		<?php if(isset($_SESSION['username'])){ ?>
			<form id="uparrow" action='../actions/action_voteStory.php' method='post'>
				<input type="image" src="https://i.imgur.com/DV6Wkiu.png">
				<input type="hidden" name="type" value="1">
				<input type="hidden" name="story" value="<?=$storyId?>">
				<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
			</form>

			<h6 id="points"><?=$points?></h6>

			<form id="downarrow" action='../actions/action_voteStory.php' method='post'>
				<input type="image" src="https://i.imgur.com/oMpyvp1.png">
				<input type="hidden" name="story" value="<?=$storyId?>">
				<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
				<input type="hidden" name="type" value="0">
			</form>
		<?php } ?>

		</div>
		
		<div id="middle">
			
			<a id="channel" href="../pages/channel.php?name=<?=$channel?>"><?=$channel?></a>
		</div>

		<div id="end">
			<a id="profile" href="../pages/profile.php?name=<?=$username?>"><?=$username?></a>
		</div>
	</section>
<?php } ?>

<?php function draw_info_bar_comment($storyId, $commentId, $username, $channel, $date, $points) { ?>
	<section id = "info_bar">
		<div id="start">

		<?php if(isset($_SESSION['username'])){ ?>
			<form id="uparrow" action='../actions/action_voteComment.php' method='post'>
				<input type="image" src="https://i.imgur.com/DV6Wkiu.png">
				<input type="hidden" name="story" value="<?=$storyId?>">
				<input type="hidden" name="type" value="1">
				<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
				<input type="hidden" name="comment" value="<?=$commentId?>">
			</form>
			
			<h6 id="points"><?=$points?></h6>

			<form id="downarrow" action='../actions/action_voteComment.php' method='post'>
				<input type="image" src="https://i.imgur.com/oMpyvp1.png">
				<input type="hidden" name="story" value="<?=$storyId?>">
				<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
				<input type="hidden" name="type" value="0">
				<input type="hidden" name="comment" value="<?=$commentId?>">
			</form>
		<?php } ?>

		</div>
		
		<div id="middle">
			
			<a id="channel" onclick="window.location.href='../pages/channel.php?name=<?=$channel?>'"><?=$channel?></a>
		</div>

		<div id="end">
			<a id="profile" onclick="window.location.href='../pages/profile.php?name=<?=$username?>'"><?=$username?></a>
		</div>
	</section>
<?php } ?>

<?php function draw_footer() { ?>
	</body>
	<footer> 
		<p>&copy; TRABALHO LTW LUÍS, RICARDO, SIMÃO</p>	<!-- FALTA DECIDIR O QUE METER NO FOOTER-->
	</footer>
	</html>
<?php } ?>