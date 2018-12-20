<?php
//
// Created by Tomasz Piechocki. 20/12/18
//

// check if the photo is not bigger than 1MB and if the format is jpg or png
function checkFile($uploaded_photo, &$model) {
    $status = true;
    print_r($uploaded_photo);
    if ($uploaded_photo['name'] != NULL && $uploaded_photo['error'] != 0) {
        $model['error']['undefined']['info'] = "Wystąpił nieznany błąd związany z plikiem.";
        return false;
    }
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $name = $uploaded_photo['tmp_name'];
    $type = finfo_file($finfo, $name);
    if ($type !== "image/jpeg" && $type !== "image/png") {
        $model['error']['format']['info'] = "Możliwe formaty plików to jpg oraz png.";
        $status = false;
    }
    if ($uploaded_photo['size'] > (1024*1024)) {
        $model['error']['size']['info'] = "Maksymalna wielkość pliku to 1 MB.";
        $status = false;
    }
    return $status;
}

// if file is ok than save in server folder
function savePhoto($uploaded_photo) {
    $upload_dir = 'images/';
    $file = $uploaded_photo['photo'];
    $name = basename($file['name']);
    $target = $upload_dir . $name;

    move_uploaded_file($file['tmp_name'], $target);
}