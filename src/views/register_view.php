<?php
    //
    // Created by Tomasz Piechocki. 28/12/18
    //
    $email = NULL;
    $login = NULL;
    if (!empty($user)) {
        $email = ($user['email']) ? $user['email'] : NULL;
        $login = ($user['login']) ? $user['login'] : NULL;
    }
    
    $page = "gallery";
    include "partial/head.php";
?>

<div class="main">
    <aside>
    
    </aside>
    <div id="content">
        <br />
        <?php
            // show errors when file is larger than 1MB or has invalid format
            if (!empty($error))
                foreach ($error as $err) {
                    echo "<span class='error'>" . $err . "</span>";
                }
    
        ?>
        
        <form  class="noBorder" method="post">
            <label for="email">Email:</label><br />
            <input type="text" name="email" id="email" value="<?= $email ?>" /><br />
            <label for="login">Login:</label><br />
            <input type="text" name="login" id="login" value="<?= $login ?>"/><br />
            <label for="password">Hasło:</label><br />
            <input type="password" name="password" id="password" /><br />
            <label for="repeat_password">Powtórz hasło:</label><br />
            <input type="password" name="repeat_password" id="repeat_password" /><br /><br />
            <input type="submit" value="Rejestracja" />
        </form>
    </div>
    <aside>

    </aside>
</div>

<?php include "partial/footer.php"; ?>
