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
    
    <aside id="subscriptions">
        <!--lista de subs do usr se nao estiver logged alargar o espaço das story -->
        <!--faz sentido ter esta barra quando se esta numa so story?-->
    </aside>

    <section id ="storys">
        <article>
            <header>Interdum et malesuada fames ac</header>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pharetra orci vel turpis sollicitudin porttitor. Quisque in ultricies orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce scelerisque odio at magna dictum gravida. Integer eu turpis tellus. Nulla facilisis tellus vitae orci ultrices facilisis at id metus. Phasellus sit amet efficitur leo, in consequat purus. Sed eget porttitor nisl. Pellentesque gravida lobortis auctor. Mauris pulvinar erat lectus, eu vulputate purus hendrerit sed. Maecenas felis felis, tincidunt finibus mi ac, lacinia efficitur orci. Vivamus fermentum mauris sed efficitur lobortis.</p>
            <p>Sed eget quam nec elit pretium cursus. Sed vulputate luctus elementum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris rutrum sapien sed turpis convallis, id tristique metus convallis. Fusce in urna eget lacus gravida suscipit. Morbi id fringilla odio, id faucibus mi. Sed rhoncus porttitor porta. Vestibulum ut faucibus enim, vitae sagittis urna. Fusce tellus lacus, ornare eu varius a, suscipit in est.</p>
            <p>Vestibulum urna mauris, placerat in accumsan ac, rutrum molestie diam. Curabitur imperdiet neque blandit sodales volutpat. Vestibulum aliquet nunc sed pharetra pharetra. Nulla tempus id diam vitae luctus. Nam volutpat eu odio at luctus. Mauris convallis diam vel ex tincidunt aliquam quis non neque. Morbi eu eros nulla. Curabitur iaculis iaculis ex, vitae tristique mi blandit a. Quisque commodo egestas nulla vitae eleifend. Vivamus sit amet felis vel augue sodales eleifend vitae id metus. Phasellus a ipsum massa.</p>
            <p>Nulla ac euismod lectus. Vivamus at mi malesuada, ornare tellus sit amet, condimentum quam. Suspendisse vitae laoreet augue, sed ullamcorper enim. Nunc vitae mollis nisi, sed cursus tellus. Pellentesque dignissim odio a nisl laoreet feugiat. Morbi gravida non leo sed dignissim. Nam elementum nec neque sit amet pretium. Duis vulputate lobortis sollicitudin. Nam eu ultrices augue, non tempor eros.</p>
        </article>
        <?php draw_info_bar('OP', null) ?>
    </section>
    
    <!--Falta zona para adicionar comments-->
    
    <section id="comments">
        <h1>x Comments</h1>
        <article class="comment">
            <p>Praesent vel gravida turpis. Vivamus id lobortis urna. Nam rutrum eleifend dictum. Donec mauris mi, maximus at arcu non, iaculis consequat sapien. Ut scelerisque pellentesque turpis, ac efficitur metus. Cras in lorem dui. Aliquam at hendrerit ante. Nunc venenatis lectus in mattis consectetur. Mauris nec consectetur turpis.</p>
            <?php draw_info_bar('USR#1', null) ?>
        </article>
        <article class="comment">
            <p>Nunc tristique elit a lectus porta, at sodales sapien mattis. Praesent quis justo ut tortor vestibulum finibus. Donec nulla urna, faucibus in interdum id, ultrices et quam. Integer at ultricies tortor. Mauris et eros ultricies, fermentum dui in, pharetra mauris. Aliquam lobortis augue sed arcu dictum viverra. Sed sagittis euismod neque at sagittis. Maecenas iaculis augue sed fringilla tempor. Donec sagittis a velit eget vestibulum. Nunc hendrerit quam risus, ac rutrum velit tincidunt a. Integer aliquam, nulla a faucibus venenatis, magna nibh scelerisque felis, a ultrices odio purus eget augue. Suspendisse urna nisi, egestas sed lacus vitae, ultrices sodales augue.</p>
            <?php draw_info_bar('USR#2', null) ?>
        </article>
        <article class="comment">
            <p>Aliquam placerat ligula dolor. Aliquam eget nulla cursus, porttitor leo ac, tristique risus. Cras tempus nunc lectus, quis rhoncus tortor pellentesque non. Duis tempor pretium aliquet. Vestibulum dictum sollicitudin sapien vitae sollicitudin. Quisque congue luctus odio in efficitur. Cras facilisis sem ac leo aliquet tempor. Nunc leo odio, posuere ac sodales sit amet, ultricies in dolor. Quisque molestie turpis eu mattis aliquet. Curabitur imperdiet lorem eu odio feugiat aliquam. Nam a scelerisque neque. Curabitur at semper diam, a luctus enim. Aliquam sit amet ex convallis, aliquam tellus vel, pharetra justo. Duis suscipit faucibus elementum.</p>
            <?php draw_info_bar('USR#3', null) ?>
        </article>
    </section>
    <?php draw_footer() ?>
</html>