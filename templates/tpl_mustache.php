<script id="tpl_story_card" type="x-tmpl-mustache">
    <button id="storyCard" onclick="window.location.href='../pages/story.php?id={{storyId}}'">
		<h1> {{title}} </h1>
		<p> {{text}} </p>

		<p>&bull; &bull; &bull;</p>
	</button>
</script>

<script id="tpl_info_bar_story" type="x-tmpl-mustache" >
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

<script id="tpl_comment" type="x-tmpl-mustache">
    <p id="usrComment">{{text}}</p>
</script>

<script id="tpl_info_bar_comment" type="x-tmpl-mustache" >
<section id = "info_bar">
		<div id="start">

		<?php if(isset($_SESSION['username'])){ ?>
			<form id="uparrow" action='../actions/action_voteComment.php' method='post'>
				<input type="image" src="../images/UpvoteGrey.png">
				<input type="hidden" name="story" value="{{storyId}}">
				<input type="hidden" name="type" value="1">
				<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
				<input type="hidden" name="comment" value="{{commentId}}">
			</form>
			
			<h6 id="points">{{points}}</h6>

			<form id="downarrow" action='../actions/action_voteComment.php' method='post'>
				<input type="image" src="../images/DownvoteGrey.png">
				<input type="hidden" name="story" value="{{storyId}}">
				<input type="hidden" name="username" value="<?=$_SESSION['username']?>">
				<input type="hidden" name="type" value="0">
				<input type="hidden" name="comment" value="{{commentId}}">
			</form>
		<?php } ?>

		</div>
		
		<div id="middle">
			<a id="date">{{published}}</a>
		</div>

		<div id="end">
			<a id="profile" onclick="window.location.href='../pages/profile.php?name={{username}}'">{{username}}</a>
		</div>
	</section>
</script>