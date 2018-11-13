<?php function draw_header($username, $channel_name) { ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="../css/header.css">
        </head>
        <body>
            <header>
                <h1><?=$channel_name?></h1>
                <?php if($username != NULL) { ?>
                    <nav id="signup">
                        <a href=""><?= $username ?></li></a>                            <!-- SE O USER CLICAR NO NOME VAI AO SEU PROFILE -->
                        <a href="../actions/action_logout.php">Logout</a>               <!-- FALTA TESTAR COM A ACTION-->
                    </nav>
                <? } else { ?>
                    <nav id="signup">
                        <a href="../actions/action_login.php">Login</a>                 <!-- FALTA TESTAR COM A ACTION-->
                        <a href="../actions/action_register.php">Register</a>           <!-- FALTA TESTAR COM A ACTION-->
                    </nav>
                <? } ?>
            </header>
<?php } ?>

<?php function draw_info_bar($username, $channel) { ?>
    <section id = "info_bar">
        <input type="radio" name="point" value="1">UP
        <input type="radio" name="point" value="-1">DOWN
        <?php if(isset($channel)) echo $channel ?>
        <?php echo(date("H:i:s")) ?>
        <?php echo($username) ?>
    </section>
<?php } ?>

<?php function draw_footer() { ?>
    </body>
    <footer> 
        <p>&copy; TRABALHO LTW LUÍS, RICARDO, SIMÃO</p>                                     <!-- FALTA DECIDIR O QUE METER NO FOOTER-->
    </footer>
    </html>
<?php } ?>