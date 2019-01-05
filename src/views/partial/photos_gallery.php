<?php
    //
    // Created by Tomasz Piechocki. 03/01/19
    //
?>

<?php if (count($photos)): ?>
    <?php foreach ($photos as $photo): ?>
        <div class="photo centerText">
            <?php if (!empty($photo['private'])) : ?>
                <a class="thumbnail" href="photo?id=<?= $photo['_id'] ?>&private=yes&page=<?= $page_number ?>">
                    <img src="<?= $photo['path_thumbnail'] ?>" alt="<?= $photo['title'] ?>" />
                </a>
            <?php else : ?>
                <a class="thumbnail" href="photo?id=<?= $photo['_id'] ?>&page=<?= $page_number ?>">
                    <img src="<?= $photo['path_thumbnail'] ?>" alt="<?= $photo['title'] ?>" />
                </a>
            <?php endif ?>
            <span><?= $photo['title'] ?></span><br />
            <?php if (!empty($photo['private'])) : ?>
                <span>Prywatne</span><br />
            <?php else : ?>
                <span><?= $photo['author'] ?></span><br />
            <?php endif ?>
            <label class="photoCheckbox">
                <?php if (!empty($photo['private'])) : ?>
                
                <?php else : ?>
                    <?php if (!empty($_SESSION['picked_ids']) && in_array($photo['_id'], $_SESSION['picked_ids'])) : ?>
                        <input class="photoCheckbox" type="checkbox" name="checked[]" value="<?= $photo['_id'] ?>"
                               checked="checked" disabled="disabled" />
                    <?php else : ?>
                        <input class="photoCheckbox" type="checkbox" name="checked[]" value="<?= $photo['_id'] ?>" />
                    <?php endif ?>
                <?php endif ?>
                
            </label>
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