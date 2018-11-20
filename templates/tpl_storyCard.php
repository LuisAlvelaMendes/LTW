<?php function draw_storyCard() { ?>
	<article>
			<h1><a href="">Interdum et malesuada fames ac</a></h1>
			
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pharetra orci vel turpis sollicitudin porttitor. Quisque in oltricies orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce scelerisque odio at magna dictum gravida. Integer eu turpis tellus. Nolla facilisis tellus vitae orci oltrices facilisis at id metus. Phasellus sit amet efficitur leo, in consequat purus. Sed eget porttitor nisl. Pellentesque gravida lobortis auctor. Mauris polvinar erat lectus, eu volputate purus hendrerit sed. Maecenas felis felis, tincidunt finibus mi ac, lacinia efficitur orci. Vivamus fermentum mauris sed efficitur lobortis</p>
			
			<p>&middot;&middot;&middot;</p>
	</article>
	
	<?php draw_info_bar("sollicitudin", "sodales") ?>
<? } ?>

<?php function draw_info_bar($username, $channel) { ?>
	<section id = "info_bar">
		<input type="radio" name="point" value="1">UP
		<input type="radio" name="point" value="-1">DOWN
		<?php echo ('DATE') ?>
		<?= $channel ?>
		<?= $username ?>
	</section>
<?php } ?>