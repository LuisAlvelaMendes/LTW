<?php
    include_once('../includes/session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_topsubs.php');
    include_once('../templates/tpl_subList.php');
    include_once('../database/db_channel.php');
    $channellist = array('pol', 'sci', 'fit', 'ocd', 'hrt');
    $numsubs = array('550', '420', '330', '210', '150');
    $channelid = array('68', '72', '44', '32', '69');
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <?php draw_header($_SESSION['username'], 'NOT REDDIT') ?>
    
    <?php draw_topsubs($channellist, $numsubs, $channelid) ?>
    
    <aside id="subscriptions">
        <!--lista de subs do usr se nao estiver logged alargar o espaço das story -->
        <?php 
            $subscribedChannelNames = getSubscribedChannels("abril");
            draw_subscriberList($subscribedChannelNames);
        ?>
    </aside>
    
    <section id="storys">
        <article>
            <header>
                <a href="index.html">Interdum et malesuada fames ac</a>
            </header>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pharetra orci vel turpis sollicitudin porttitor. Quisque in oltricies orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce scelerisque odio at magna dictum gravida. Integer eu turpis tellus. Nolla facilisis tellus vitae orci oltrices facilisis at id metus. Phasellus sit amet efficitur leo, in consequat purus. Sed eget porttitor nisl. Pellentesque gravida lobortis auctor. Mauris polvinar erat lectus, eu volputate purus hendrerit sed. Maecenas felis felis, tincidunt finibus mi ac, lacinia efficitur orci. Vivamus fermentum mauris sed efficitur lobortis...</p>
            <footer>
                <span class="author">sollicitudin</span>
                <span class="channel"><a href="index.html">sodales</a></span>
                <span class="date">0</span>
                <span class="comments"><a href="index.html">0</a></span>
            </footer>
            <?php draw_info_bar('SIMAWATT', 'CHANNEL') ?>
        </article>
    </section>
    
    <?php draw_footer() ?>
</html>