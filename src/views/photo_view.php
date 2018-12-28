<?php
//
// Created by Tomasz Piechocki. 27/12/18
//

$page = "gallery";
include "partial/head.php";
?>

<div class="main">
    <aside>

    </aside>
    <div id="content">
        <div class="fullPhotoBox">
            <img class="fullPhoto" src="<?= $photo['path_watermark'] ?>" alt="<?= $photo['title'] ?>" />
            <p>
                <i>"<?= $photo['title'] ?>"</i> - <?= $photo['author'] ?>
            </p>
            <a class="linkButton" href="gallery?page=<?= $position ?>">Powrót</a>
            <a class="linkButton" href="remove?id=<?= $photo['_id'] ?>">Usuń</a>
        </div>
    </div>
    <aside>

    </aside>
</div>

<?php include "partial/footer.php"; ?>
