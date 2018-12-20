<?php
//
// Created by Tomasz Piechocki. 20/12/18
//

$page = "contact";
include "partial/head.php";
?>

<div class="main">
    <aside>

    </aside>
    <div id="content">
        <?php
        foreach ($_POST as $key => $value)
            if ($key !== "requesttype")
                echo $key.'='.$value.'<br />';
            else {
                foreach ($_POST['requesttype'] as $value) {
                    echo 'Checked: ' . $value . "<br />";
                }
            }
        ?>
    </div>
    <aside>

    </aside>
</div>


<?php include "partial/footer.php"; ?>
