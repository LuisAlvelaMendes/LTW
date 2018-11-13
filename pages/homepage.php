<?php 
    include_once('../templates/tpl_common.php');
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Lorem ipsum dolor sit amet</title>
        <meta charset="utf-8">
    </head>
    <?php draw_header('SIMAWATT', 'REDDIT') ?>
    
    <nav id="top_ch">
        <ul>
            <li>Vestibulum</li>
            <li>Praesent</li>
            <li>Donec</li>
            <li>Phasellus</li>
            <li>Phasellus</li>
        </ul>
    </nav>
    
    <aside id="subscriptions">
        <!--lista de subs do usr se nao estiver logged alargar o espaço das story -->
    </aside>
    
    <section id="storys">
        <article>
            <header>
                <a href="index.html">Interdum et malesuada fames ac</a>
            </header>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pharetra orci vel turpis sollicitudin porttitor. Quisque in ultricies orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce scelerisque odio at magna dictum gravida. Integer eu turpis tellus. Nulla facilisis tellus vitae orci ultrices facilisis at id metus. Phasellus sit amet efficitur leo, in consequat purus. Sed eget porttitor nisl. Pellentesque gravida lobortis auctor. Mauris pulvinar erat lectus, eu vulputate purus hendrerit sed. Maecenas felis felis, tincidunt finibus mi ac, lacinia efficitur orci. Vivamus fermentum mauris sed efficitur lobortis...</p>
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