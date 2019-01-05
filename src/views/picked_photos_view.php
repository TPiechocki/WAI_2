<?php
//
// Created by Tomasz Piechocki. 30/12/18
//
    
    $page = "gallery";
    include "partial/head.php";
?>
    
    <div class="main">
        <aside>
            <?php include "partial/login_view.php" ?>
        </aside>
        <div id="content">
            <form method="post" id="photosForm" action="remove_choice?page=<?= $page_number ?>">
                <?php if (count($photos)): ?>
                    <?php foreach ($photos as $photo): ?>
                        <div class="photo centerText">
                            <a class="thumbnail" href="photo?id=<?= $photo['_id'] ?>&picked=yes&page=<?= $page_number ?>">
                                <img src="<?= $photo['path_thumbnail'] ?>" alt="<?= $photo['title'] ?>" />
                            </a>
                            <span><?= $photo['title'] ?></span><br />
                            <?php if (!empty($photo['private'])) : ?>
                                <span>Prywatne</span><br />
                            <?php else : ?>
                                <span><?= $photo['author'] ?></span><br />
                            <?php endif ?>
                            <label class="photoCheckbox">
                                <input class="photoCheckbox" type="checkbox" name="checked[]" value="<?= $photo['_id'] ?>" />
                            </label>
                            <?php if (!empty($_SESSION['usergroup']) && $_SESSION['usergroup'] === "admin") : ?>
                                <a class="linkButton" href="remove?id=<?= $photo['_id'] ?>">Usuń</a>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>
                <?php endif; ?>
            </form>
            <div class="pagenav">
                <?php if ($page_number > 2): ?>
                    <a href="picked?page=1">&laquo;</a>
                <?php endif ?>
                <?php if (!empty($previous_page)) : ?>
                    <a href="picked?page=<?= $previous_page ?>">&#8249;</a>
                <?php endif ?>
                <span><?= $page_number . '/' . $number_of_pages ?></span>
                <?php if ($page_number < $number_of_pages): ?>
                    <a href="picked?page=<?= $next_page ?>">&#8250;</a>
                <?php endif ?>
                <?php if ($page_number < $number_of_pages-1): ?>
                    <a href="picked?page=<?= $number_of_pages ?>">&raquo;</a>
                <?php endif ?>
            </div>
            <div class="saveChoice">
                <input class="linkButton" type="submit" form="photosForm" value="Usuń zaznaczone z zapamiętanych" />
            </div>
        </div>
        <aside>
            <?php include "partial/upload_photo_view.php" ?>
        </aside>
    </div>

<?php include "partial/footer.php"; ?>