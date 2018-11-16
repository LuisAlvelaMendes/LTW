<?php 
    include_once('../templates/tpl_common.php');
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Lorem ipsum dolor sit amet</title>
        <link rel="stylesheet" href="../css/top_subs.css">
        <meta charset="utf-8">
    </head>

    <?php draw_header('SIMAWATT', 'REDDIT') ?>
    
    <nav id="top_ch">
        <ul>
            <li><a href="">Vestibolum</a></li>
            <li>Num_subs1</li>
            <li><a href="">Praesent</a></li>
            <li>Num_subs2</li>
            <li><a href="">Donec</a></li>
            <li>Num_subs3</li>
            <li><a href="">Phasellus</a></li>
            <li>Num_subs4</li>
            <li><a href="">Phasellus</a></li>
            <li>Num_subs5</li>
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