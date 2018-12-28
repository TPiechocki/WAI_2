<?php
//
// Created by Tomasz Piechocki. 20/12/18
//

// check if the uploaded photo is not bigger than 1MB and if the format is jpg or png
// model stores error messages
function checkPhoto($uploaded_photo, &$model) {
    $status = true;
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

/**
 * Create and save the thunmbail
 * @param $source - original photo
 * @param $destination - path for transformed photo
 * @param $type - file extension (jpg or png)
 */
function createThumbnail($source, $destination, $type) {
    // load source file
    if ($type === "jpg") {
        $orig_image = imagecreatefromjpeg($source);
    }
    elseif ($type === "png") {
        $orig_image = imagecreatefrompng($source);
    }
    else {
        return;
    }

    // get original size and set desired size for thumbnail
    $orig_width = imagesx($orig_image);
    $orig_height = imagesy($orig_image);

    // max icon size is 125px high or 200px wide
    $desired_height = 125;
    $desired_width = $orig_width * ($desired_height/$orig_height);
    if ($desired_width > 200) {
        $desired_width = 200;
        $desired_height = $orig_height * ($desired_width/$orig_width);
    }

    // create place for transformed photo
    $thumb_image = imagecreatetruecolor($desired_width, $desired_height);

    // move resized original photo to thumb_image variable and then save file in destinataion
    imagecopyresized($thumb_image, $orig_image, 0, 0, 0, 0,
        $desired_width, $desired_height, $orig_width, $orig_height);
    imagejpeg($thumb_image, $destination);

    // clear the memory
    imagedestroy($orig_image);
    imagedestroy($thumb_image);
}

/**
 * Create and save photo with added watermark
 * @param $source - original photo
 * @param $destination - path for transformed photo
 * @param $type - file extension (jpg or png)
 * @param $watermark - text to be included in watermark
 */
function createImageWithWatermark($source, $destination, $type, $watermark) {
    // load source file
    if ($type === "jpg") {
        $orig_image = imagecreatefromjpeg($source);
    }
    elseif ($type === "png") {
        $orig_image = imagecreatefrompng($source);
    }
    else {
        return;
    }

    // get original size and set size for thumbnail
    $orig_width = imagesx($orig_image);
    $orig_height = imagesy($orig_image);
    $fontSize = $orig_width/20;
    $fontPath = "static/fonts/watermark.ttf";

    //get size of text, to get center coordinate on image
    $textCoords=imagettfbbox($fontSize , -45 , $fontPath , $watermark );

    $mark_width =  $textCoords[4] - $textCoords[6] + 20;
    $mark_height = $textCoords[1] - $textCoords[7] + 5;

    $textcolor = imagecolorallocatealpha($orig_image, 100, 100, 100, 48);
    imagettftext($orig_image, $fontSize, -45, $orig_width - $mark_width, $mark_height, $textcolor, $fontPath, $watermark);

    imagejpeg($orig_image, $destination);

    imagedestroy($orig_image);
}
