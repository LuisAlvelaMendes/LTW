<?php function draw_login() { ?>
    <form id="myModal" action="../actions/action_login.php" method="post">
        <section class="modal-content">
            <span class="close">&times;</span>
            
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
        </section>
    </form>
<? } ?>