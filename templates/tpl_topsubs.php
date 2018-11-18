<?php function draw_topsubs($channellist, $numsubs, $channelid) { ?>
    <head>
        <link rel="stylesheet" href="../css/top_subs.css">
    </head>

    <section id="top_ch">
        <? for($i=0; $i < 5; $i++) { ?>
        <button type="button" onclick="window.location.href='../pages/channel.php?id=<?= $channelid[$i] ?>'">
            <h1><?=$channellist[$i]?></h1>
            <h2><?=$numsubs[$i]?></h2>
        </button>
        <? } ?>
    </section> 
<? } ?>