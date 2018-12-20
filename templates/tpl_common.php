<?php 
	include_once('tpl_story.php');
	include_once('../templates/tpl_sub.php');

	include_once('../database/db_story.php');
	include_once('../database/db_channel.php');
	include_once('../database/db_user.php'); 
?>

<?php // Draws headder banner present in the start of every page ?>
<?php function draw_header($username, $channel, $title) { ?>
	<!DOCTYPE html>
	<html>
		<head>
			<title><?=$title?></title>
			<meta charset="utf-8" />
			<link rel="stylesheet" href="../css/common.css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
		</head>

		<body>
			<header>
				<?php if($channel === "Homepage") { ?>
					<a id="title" href="../pages/homepage.php"><?=$channel?></a>
				<?php } else { ?>
					<a id="title" href="../pages/channel.php?name=<?=$channel?>"><?=$channel?></a>

					<?php $subscribers = getNumberOfSubscribers($channel) ?>

					<?php if($subscribers[0]["subscribers"] === '1') {?>
						<a id="subscribers"><?=$subscribers[0]["subscribers"]?> subscriber </a>
					<?php } else { ?>
						<a id="subscribers"><?=$subscribers[0]["subscribers"]?> subscribers </a>						
					<?php } ?>

					<a id="home" href="../pages/homepage.php"><i class="fas fa-home"></i></a>

				<?php } ?>

				<?php if($username != NULL) { ?>
					<nav id="signup">
						<a id="profile" href="../pages/profile.php?name=<?=$username?>"><?= $username ?></a>
						<a href="../actions/action_logout.php">Logout
						<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
						</a>
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

<?php // Scans text for references to user or channels and creates links to them ?>
<?php function draw_references($text) { 
	// References to a channel with #
	preg_match_all("/#(\\w+)/", $text, $channelMatches);

	if(!empty($channelMatches)){
		$channelName = $channelMatches[1];
		if($channelName != ''){
			$replace1 = preg_replace_callback("/#(\\w+)/",  
			
			function($matches) {
				if(channelExists($matches[1])){
					return '<a href="../pages/channel.php?name=' . $matches[1] . '">' . $matches[1] . '</a>';
				}
				return $matches[0];
			}, 
			$text);
		}
	}

	// References to a user with @
	if(!isset($replace1)){
		preg_match("/@(\\w+)/", $text, $userMatches);
	}
	else{
		preg_match("/@(\\w+)/", $replace1, $userMatches);
	}
	if(!empty($userMatches)){
		$userName = $userMatches[1];

		if($userName != ''){
			
			if(!isset($replace1)){
				$finaltext = preg_replace_callback ("/@(\\w+)/", 
				
				function($matches){
					if(usernameExists($matches[1])){
						return '<a href="../pages/profile.php?name=' . $matches[1] . '">' . $matches[1] . '</a>';
					}
					return $matches[0];
				},
				$text);
			}
			else{
				$finaltext = preg_replace_callback ("/@(\\w+)/", 

				function($matches){
					if(usernameExists($matches[1])){
						return '<a href="../pages/profile.php?name=' . $matches[1] . '">' . $matches[1] . '</a>';
					}
					return $matches[0];
				},
				$replace1);
			}
			return $finaltext;
		}
	}

	if(!isset($replace1)){
		return $text;
	}

	return $replace1;
} ?>

<?php // Converts stored date to normal format ?>
<?php function convert_epoch($epoch){
	$dt = new DateTime("@$epoch");
	return $dt;
} ?>

<?php // Given the date calculates the elapsed time to now ?>
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

<?php // Draws infor bar for stories when they are first displayed ?>
<?php function draw_info_bar_story($storyId, $author, $channel, $date, $points) { ?>
	<?php if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	} else {
		$username = -1;
	} ?>

	<section class="infoBar">
		
		<div id="start">
			<input type="checkbox" class="up" data-id=<?=$storyId?> data-point="1" data-username=<?=$username?>>
			<h6 id="points"><?=$points?></h6>
			<input type="checkbox" class="down" data-id=<?=$storyId?> data-point="0" data-username=<?=$username?>>
		</div>
		
		<div id="middle">
			<a id="date"><?=time_elapsed('@' . $date)?></a>
			<a id="channel" href="../pages/channel.php?name=<?=$channel?>"><?=$channel?></a>
		</div>

		<div id="end">
			<a id="profile" href="../pages/profile.php?name=<?=$author?>"><?=$author?></a>
		</div>

	</section>
<?php } ?>

<?php // Draws footer present at the end of every page ?>
<?php function draw_footer() { ?>
	</body>
	<footer> 
		<p>&copy; Trabalho LTW Luís, Ricardo, Simão</p>	
	</footer>
	</html>
<?php } ?>