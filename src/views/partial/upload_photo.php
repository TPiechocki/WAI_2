<?php
//
// Created by Tomasz Piechocki. 17/12/18
//
?>

<div>
    <form method="post" enctype="multipart/form-data">
        <br />
        <?php
        // show errors when file is larger than 1MB or has invalid format
        if (!empty($error))
            foreach ($error as $err) {
                echo "<p class='error'>" . $err['info'] . "</p>";
            }

        ?>
        <input type="file" name="photo" id="upload" /><br /><br />
        <label for="watermark">Znak wodny: </label>
        <input type="text" name="watermark" id="watermark" /><br /><br />
        <input type="submit" value="Wyślij" name="upload_photo" />
    </form>
</div>
