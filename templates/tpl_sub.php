<?php
  include_once('../includes/session.php'); 

  include_once('../database/db_channel.php'); 
?>

<?php function draw_subscriberList() { ?>
  <script src="../scripts/dropmenu.js" async></script>
  <link rel="stylesheet" href="../css/subList.css">
  
  <section class="dropdown">
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

<?php function draw_topsubs($channellist, $numsubs, $channelid) { ?>
    <link rel="stylesheet" href="../css/top_subs.css">

    <section id="top_ch">
        <? for($i=0; $i < 5; $i++) { ?>
        <button type="button" onclick="window.location.href='../pages/channel.php?id=<?= $channelid[$i] ?>'">
            <h1><?=$channellist[$i]?></h1>
            <h2><?=$numsubs[$i]?></h2>
        </button>
        <? } ?>
    </section> 
<? } ?>