
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

<?php function draw_sort() { ?>
<form method="post" name="form2">
  <label> Sort by</label>
  <select name="type" id="type">
    <option value="Date">Date</option>
    <option value="Comments">Comments</option>
    <option value="Points">Points</option>
  </select>
</form>

<?php } ?>


