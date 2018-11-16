<?php
  include_once("../database/db_getSubscribedChannelList.php");

  function draw_subscriberList($subscribedChannelsNames){
    foreach( $subscribedChannelsNames as $channelName) {
      echo '<p>' . $channelName['channel'] . '</p>';
    }
  }
  
?>