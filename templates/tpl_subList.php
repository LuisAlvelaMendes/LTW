<?php
  include_once('../database/db_channel.php'); 
  include_once('../includes/session.php'); 
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
          <a href=""><?=$channelName['channel']?></a>
        <?php }
      } ?>
    </section>    
  </section>
<?php } ?>