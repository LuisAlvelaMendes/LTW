<?php
  include_once('../includes/session.php'); 
  include_once('../database/db_channel.php'); 
?>

<?php function draw_subscriberList() { ?>
  <link rel="stylesheet" href="../css/subList.css">
  <script src="../scripts/dropmenu.js" async></script>
  
  <section id="dropdown" class="dropdown">
    <button onclick="myFunction()" class="dropbtn">&#9660;</button>

    <section id="myDropdown" class="dropdown-content">
      <?php 
      $subscribedChannelsNames = getSubscribedChannels($_SESSION['username']);
      if(empty($subscribedChannelsNames)) { ?>
        <a id="Empty">Empty</a>
      <?php } else {
        foreach( $subscribedChannelsNames as $channelName) { ?>
          <a onclick="window.location.href='../pages/channel.php?name=<?=$channelName['channel']?>'"><?=$channelName['channel']?></a>
        <?php }
      } ?>
    </section>    
  </section>
<?php } ?>

<?php function draw_subscribersAside($username) { ?>
  <link rel="stylesheet" href="../css/story.css">

  <section id="subscriptions">
      <h3> User's Subscribed Channels: </h3>
      
      <?php 
      $subscribedChannelsNames = getSubscribedChannels($username);

      if(empty($subscribedChannelsNames)) { ?>
        <p> User has not subscribed to any channel..</p>
      <?php } else {
        foreach( $subscribedChannelsNames as $channelName) { ?>
          <p><a onclick="window.location.href='../pages/channel.php?name=<?=$channelName['channel']?>'"><?=$channelName['channel']?></a></p>
        <?php }
      } ?>
  </section>
<?php } ?>

<?php function draw_topchannels($topchannels) { ?>
    <link rel="stylesheet" href="../css/top_subs.css">

    <section id="top_ch">
        <? foreach($topchannels as $channel) { ?>
        <button type="button" onclick="window.location.href='../pages/channel.php?name=<?= $channel['name'] ?>'">
            <h1><?=$channel['name']?></h1>
            <h2><?=$channel['subscribers']?></h2>
        </button>
        <? } ?>
    </section> 
<?php } ?>