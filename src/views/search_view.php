<?php
    //
    // Created by Tomasz Piechocki. 03/01/19
    //
    
    $page = "gallery";
    include "partial/head.php";
?>

<div class="main">
    <aside>
        <?php include "partial/login_view.php" ?>
    </aside>
    <div id="content">
        <form id="searchBar">
            <input type='text' onkeyup="searchPhotos(this.value, 1)" placeholder="Wyszukaj zdjęcie..."
                <?php if (!empty($_GET['str'])) : ?>
                    value="<?= $_GET['str'] ?>"
                <?php endif ?>
            />
        </form>
        <div id="searchResult">
        
        </div>
    </div>
    <aside>
        <?php include "partial/upload_photo_view.php" ?>
    </aside>
</div>

<script>
    function searchPhotos (str, page) {
        if (str.length === 0) {
            document.getElementById("searchResult").innerHTML = "";
        }
        else {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("searchResult").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "search_result?str=" + str + "&page=" + page, true);
            xmlhttp.send();
        }
    }
    <?php if (!empty($_GET['str'])) : ?>
        <?php
                if (empty($_GET['page']))
                    $page_number = 1;
                else
                    $page_number = $_GET['page'];
        ?>
        searchPhotos(<?= "'" . $_GET['str'] . "'" . ',' . $page_number ?>);
    <?php endif ?>
</script>

<?php include "partial/footer.php"; ?>