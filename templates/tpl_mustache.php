<?php // Draws storyCard after sorting stories ?>
<script id="tpl_story_card" type="x-tmpl-mustache">
	<button class="storyCardButton" onclick="window.location.href='../pages/story.php?id={{storyId}}'">
		<h1>{{title}}</h1>
		<p>{{text}}</p>

		<p>&bull; &bull; &bull;</p>
	</button>

	<section class="infoBar">
	
		<div class="start">
			<input type="checkbox" class="up" data-id={{storyId}} data-point="1" data-username={{username}}>
			<h6 id="points">{{points}}</h6>
			<input type="checkbox" class="down" data-id={{storyId}} data-point="0" data-username={{username}}>
		</div>
		
		<div class="middle">
			<a id="date">{{published}}</a>
		</div>

		<div class="end">
			<a id="profile" href="../pages/profile.php?name={{author}}">{{author}}</a>
		</div>

	</section>
</script>

<?php // Draws new comment at the start or after a new one ?>
<script id="tpl_comment" type="x-tmpl-mustache">
    <p class="usrComment">{{{text}}}</p>

	<section class="infoBar">

		<div class="start">
			<input type="checkbox" class="up" data-id={{commentId}} data-point="1" data-username={{username}}>
			<h6 id="points">{{points}}</h6>
			<input type="checkbox" class="down" data-id={{commentId}} data-point="0" data-username={{username}}>
		</div>
		
		<div class="middle">
			<a id="date">{{date}}</a>
		</div>

		<div class="end">
			<a id="profile" onclick="window.location.href='../pages/profile.php?name={{author}}'">{{author}}</a>
		</div>

	</section>
</script>