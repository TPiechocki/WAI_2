<?php
    //
    // Created by Tomasz Piechocki. 28/12/18
    //
?>

<form method="post" action="log_in">
    
    <?php if (!empty($_SESSION['username'])) : // if user is logged ?>
        <div class="centerText">
            <br />
            <?php
                if (!empty($logged)) {
                    echo "<span class='error positive'>" . $logged . "</span>";
                }
            ?>
            <span>Zalogowany jako: <?= $_SESSION['username'] ?></span><br /><br />
            <a class='linkButton fromButton' href="log_out">Wyloguj</a>
        </div>
        
        
    <?php else : // if there's no logged user ?>
        <br />
        <?php
        if (!empty($errorLogin))
            foreach ($errorLogin as $err) {
                echo "<p class='error'>" . $err . "</p>";
            }
    
        ?>
        <label for="login">Login:</label><br />
        <input type="text" name="login" id="login" /><br /><br />
        <label for="password">Hasło:</label><br />
        <input type="password" name="password" id="password" /><br /><br />
        <input type="submit" value="Zaloguj" class="formButton" /><br /><br />
        <input type="button" onclick="location.href='register'" value="Rejestracja" class="formButton" />
    <?php endif; ?>
    
</form>
