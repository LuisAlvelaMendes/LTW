<?php 
    include_once('../includes/session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_sub.php');

    if(!isset($_SESSION['username'])) {
        draw_header(null, 'NOT REDDIT');
    } else {
        draw_header($_SESSION['username'], 'NOT REDDIT');
    }

    draw_subscriberList();

    draw_footer();
?> 

<aside id="subscriptions">
    <!--lista de subs do usr se nao estiver logged alargar o espaço das story -->
</aside>

<section id="profile_info">
    <span class="user"></span>
</section>

    <?php draw_footer() ?>