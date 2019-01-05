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
            <?php if (!empty($_GET['picked']) && $_GET['picked'] === "yes") : ?>
                <a class="linkButton" href="picked?page=<?= $_GET['page'] ?>">Powrót</a>
            <?php elseif (!empty($_GET['str'])) : ?>
                <a class="linkButton" href="search?str=<?= $_GET['str'] ?>&page=<?= $_GET['page'] ?>">Powrót</a>
            <?php else : ?>
                <a class="linkButton" href="gallery?page=<?= $_GET['page'] ?>">Powrót</a>
            <?php endif ?>
            <?php if (!empty($_SESSION['usergroup']) && $_SESSION['usergroup'] === "admin") : ?>
                <a class="linkButton" href="remove?id=<?= $photo['_id'] ?>">Usuń</a>
            <?php endif ?>
        </div>
    </div>
    <aside>

    </aside>
</div>

<?php include "partial/footer.php"; ?>
