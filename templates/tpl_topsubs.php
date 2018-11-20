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