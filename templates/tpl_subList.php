<?php
  include_once('../database/db_channel.php'); 
  include_once('../includes/session.php'); 
?>

<?php function draw_subscriberList() { ?>
  <script src="../scripts/dropmenu.js" async></script>
  <link rel="stylesheet" href="../css/subList.css">
  <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn">&#9660;</button>

    <div id="myDropdown" class="dropdown-content">
      <?php 
      $subscribedChannelsNames = getSubscribedChannels("abril");
      foreach( $subscribedChannelsNames as $channelName) {
        echo '<a>' . $channelName['channel'] . '</a>';
      } ?>
    </div>    
  </div>
<?php } ?>