<?php
    //
    // Created by Tomasz Piechocki. 03/01/19
    //
?>

<?php if (count($photos)): ?>
    <?php foreach ($photos as $photo): ?>
        <div class="photo centerText">
            <?php if (!empty($photo['private'])) : ?>
                <a class="thumbnail"
                   href="photo?id=<?= $photo['_id'] ?>&private=yes&str=<?= $_GET['str'] ?>&page=<?= $page_number ?>">
                    <img src="<?= $photo['path_thumbnail'] ?>" alt="<?= $photo['title'] ?>" />
                </a>
            <?php else : ?>
                <a class="thumbnail" href="photo?id=<?= $photo['_id'] ?>&str=<?= $_GET['str'] ?>&page=<?= $page_number ?>">
                    <img src="<?= $photo['path_thumbnail'] ?>" alt="<?= $photo['title'] ?>" />
                </a>
            <?php endif ?>
            <span><?= $photo['title'] ?></span><br />
            <?php if (!empty($photo['private'])) : ?>
                <span>Prywatne</span><br />
            <?php else : ?>
                <span><?= $photo['author'] ?></span><br />
            <?php endif ?>
            <?php if (!empty($_SESSION['usergroup']) && $_SESSION['usergroup'] === "admin") : ?>
                <?php if (!empty($photo['private'])) : ?>
                    <a class="linkButton" href="remove?id=<?= $photo['_id'] ?>&private=yes">Usuń</a>
                <?php else : ?>
                    <a class="linkButton" href="remove?id=<?= $photo['_id'] ?>">Usuń</a>
                <?php endif ?>
            <?php endif ?>
        </div>
    <?php endforeach ?>
<?php endif; ?>

<div class="pagenav">
    <?php if ($page_number > 2): ?>
        <div onclick="searchPhotos(<?= "'" . $_GET['str'] . "'" . ',' . 1 ?>)">&laquo;</div>
    <?php endif ?>
    <?php if (!empty($previous_page)) : ?>
        <div onclick="searchPhotos(<?= "'" . $_GET['str'] . "'" . ',' . $previous_page ?>)">&#8249;</div>
    <?php endif ?>
    <span><?= $page_number . '/' . $number_of_pages ?></span>
    <?php if ($page_number < $number_of_pages): ?>
        <div onclick="searchPhotos(<?= "'" . $_GET['str'] . "'" . ',' . $next_page ?>)">&#8250;</div>
    <?php endif ?>
    <?php if ($page_number < $number_of_pages-1): ?>
        <div onclick="searchPhotos(<?= "'" . $_GET['str'] . "'" . ',' . $number_of_pages ?>)">&raquo;</div>
    <?php endif ?>
</div>
