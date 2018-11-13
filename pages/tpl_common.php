<?php function draw_header($username, $channel_name) { ?>
    <<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>Page Title</title>
        </head>
        <body>
            <header>
                <h1><?=$channel_name?></h1>
                <?php if($username != NULL) { ?>
                    <nav>
                        <ul>
                            <li><?=$username?></li>
                            <li><a href="../actions/action_logout.php">Logout</a></li>
                        </ul>
                    </nav>
                <? } else { ?>
                    <nav>
                        <ul>
                            <li>Login</li>
                            <li>Register</li>
                        </ul>
                    </nav>
                <?}?>
            </header>
        </body>
    </html>
<?php } ?>
