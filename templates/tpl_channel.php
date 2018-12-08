

<?php function drawStories($stories, $channel) { ?>
	<link rel="stylesheet" href="../css/storyCard.css">
	<script src="../scripts/sortStories.js" async></script>
	<script src="../scripts/mustache.js" async></script>

	<input id="channel_name" type="hidden" name="channel" value="<?=$channel?>">

	<label> Sort by </label>
    <select id="sort">
      <option>Date</option>
      <option>Comments</option>
      <option>Points</option>
	</select>
	
	<section id="story_cards">
		<?php foreach($stories as $story) { ?>

			<button id="storyCard" class="storyCards" onclick="window.location.href='../pages/story.php?id=<?=$story['id']?>'">
				<h1> <?=htmlspecialchars($story['title'])?> </h1>
				<p> <?=htmlspecialchars($story['fulltext'])?> </p>
				<?php draw_info_bar_story($story['id'], $story['author'], null, $story['published'], $story['points']) ?>

				<p>&bull; &bull; &bull;</p>
			</button>

		<?php } ?>

	</section>
<?php } ?>

<?php function draw_search() { ?>
	<input id="country" name="country" type="text">

<?php } ?>

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

<script id="template" type="x-tmpl-mustache" >
    <section id = "info_bar">
        <div id="start">

        <?php if(isset($_SESSION['username'])){ ?>
            <form id="uparrow" action='../actions/action_voteStory.php' method='post'>
                <input type="image" src="https://i.imgur.com/DV6Wkiu.png">
                <input type="hidden" name="type" value="1">
                <input type="hidden" name="story" value="{{storyId}}">
                <input type="hidden" name="username" value="<?=$_SESSION['username']?>">
            </form>

            <h6 id="points">{{points}}</h6>

            <form id="downarrow" action='../actions/action_voteStory.php' method='post'>
                <input type="image" src="https://i.imgur.com/oMpyvp1.png">
                <input type="hidden" name="story" value="{{storyId}}">
                <input type="hidden" name="username" value="<?=$_SESSION['username']?>">
                <input type="hidden" name="type" value="0">
            </form>
        <?php } ?>

        </div>
    
        <div id="middle">
			<a> {{published}} </a>
        </div>

        <div id="end">
            <a id="profile" href="../pages/profile.php?name={{username}}">{{username}}</a>
        </div>
    </section>
</script>

