<?php
//
// Created by Tomasz Piechocki. 17/12/18
//

$page = "gallery";
include "partial/head.php";
?>

<div class="main">
    <aside>

    </aside>
    <div id="content">
        <?php if (count($photos)): ?>
            <?php foreach ($photos as $photo): ?>
                <div class="photo centerText">
                    <a class="thumbnail" href="photo?id=<?= $photo['_id'] ?>">
                        <img src="<?= $photo['path_thumbnail'] ?>" alt="<?= $photo['title'] ?>" />
                    </a>
                    <span><?= $photo['title'] ?></span><br />
                    <span><?= $photo['author'] ?></span><br />
                    <a class="linkButton" href="remove?id=<?= $photo['_id'] ?>">Usuń</a>
                </div>
            <?php endforeach ?>
        <?php endif; ?>
        <div class="pagenav">
            <?php if ($page_number > 2): ?>
                <a href="gallery?page=1">&laquo;</a>
            <?php endif ?>
            <?php if (!empty($previous_page)) : ?>
                <a href="gallery?page=<?= $previous_page ?>">&#8249;</a>
            <?php endif ?>
            <span><?= $page_number . '/' . $number_of_pages ?></span>
            <?php if ($page_number < $number_of_pages): ?>
                <a href="gallery?page=<?= $next_page ?>">&#8250;</a>
            <?php endif ?>
            <?php if ($page_number < $number_of_pages-1): ?>
                <a href="gallery?page=<?= $number_of_pages ?>">&raquo;</a>
            <?php endif ?>
        </div>
    </div>
    <aside>
        <?php include "partial/upload_photo_view.php" ?>
    </aside>
</div>

<?php include "partial/footer.php"; ?>