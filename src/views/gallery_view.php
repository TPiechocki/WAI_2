<?php
//
// Created by Tomasz Piechocki. 17/12/18
//

$page = "gallery";
include "partial/head.php";
?>

<div class="main">
    <aside>
        <?php include "partial/login_view.php" ?>
    </aside>
    <div id="content">
        <form method="post" id="photosForm" action="save_choice?page=<?= $page_number ?>">
            <?php require "partial/photos_gallery.php" ?>
        </form>
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
        <div class="saveChoice">
            <input class="linkButton" type="submit" form="photosForm" value="Zapamiętaj wybrane" />
        </div>
    </div>
    <aside>
        <?php include "partial/upload_photo_view.php" ?>
    </aside>
</div>

<?php include "partial/footer.php"; ?>