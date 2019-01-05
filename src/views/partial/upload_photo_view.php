<?php
//
// Created by Tomasz Piechocki. 17/12/18
//
?>

<div>
    <form method="post" action="upload" enctype="multipart/form-data">
        <br />
        <?php
        // show errors when file is larger than 1MB or has invalid format
        if (!empty($error))
            foreach ($error as $err) {
                echo "<p class='error'>" . $err['info'] . "</p>";
            }

        ?>
        
        <input type="file" name="photo" id="upload" /><br /><br />
        
        <label for="watermark">Znak wodny: </label><br />
        <input type="text" name="watermark" id="watermark" /><br /><br />
        
        <label for="title">Tytuł: </label><br />
        <input type="text" name="title" id="title" /><br /><br />
        
        <label for="author">Autor: </label><br />
        <input type="text" name="author" id="author"
            <?php if (!empty($_SESSION['username'])) echo "readonly class='inputDisabled' value='" . $_SESSION['username'] . "'"?> /><br /><br />
        
        <?php if (!empty($_SESSION['username'])) : ?>
            <input type="radio" name="privacy" value="public" id="public" checked="checked" />
            <label for="public">Publiczne</label><br />
            <input type="radio" name="privacy" value="private" id="private" />
            <label for="private">Prywatne</label><br /><br />
        <?php endif ?>
        
        <input type="submit" value="Wyślij" class="formButton" />
    </form>
</div>
