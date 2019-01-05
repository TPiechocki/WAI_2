<?php
//
// Created by Tomasz Piechocki. 20/12/18
//

use MongoDB\BSON\ObjectID;

// validate form and upload photo
function uploadPhoto(&$model) {
        $model['error'] = NULL;
        $check_status = true;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_FILES['photo']['name'])) {
                $model['error']['nophoto']['info'] = "Musisz dodać zdjęcie.";
            }
            if (empty($_REQUEST['watermark'])) {
                $model['error']['nowatermark']['info'] = "Musisz dodać treść znaku wodnego.";
            }
            if (!empty($_FILES['photo']['name'])) {
                $check_status = checkPhoto($_FILES['photo'], $model);
            }
            if (!empty($_REQUEST['watermark']) && strlen($_REQUEST['watermark']) > 24) {
                $model['error']['watermark']['info'] = "Znak wodny może mieć co najwyżej 24 znaki.";
                $check_status = false;
            }
            if (!empty($_REQUEST['title']) && strlen($_REQUEST['title']) > 24) {
                $model['error']['title']['info'] = "Tytuł może mieć co najwyżej 24 znaki.";
                $check_status = false;
            }
            if (!empty($_REQUEST['author']) && strlen($_REQUEST['author']) > 24) {
                $model['error']['watermark']['info'] = "Nazwa autora może mieć co najwyżej 24 znaki.";
                $check_status = false;
            }
            if (!empty($_FILES['photo']['name'] && !empty($_REQUEST['watermark']))) {
                if ($check_status) {
                    addPhoto($_FILES['photo']);
                    return 'redirect:gallery';
                }
            }
        }
        return gallery($model);
    }

// check and save the uploaded photo
function addPhoto($file) {
        $photo = [
            '_id' => new ObjectID(),
            'name' => basename($file['name']),
            'type' => pathinfo($file['name'], PATHINFO_EXTENSION),
            'path_orig' => NULL,
            'path_thumbnail' => NULL,
            'path_watermark' => NULL,
            'watermark' => filter_var($_REQUEST['watermark'], FILTER_SANITIZE_STRING),
            'title' => "Bez tytułu",
            'author' => "Anonim",
            'date' => date('YmdHis'),
        ];
        $photo['path_orig'] = 'images/original/' . $photo['_id'] . '.' . $photo['type'];
        $photo['path_thumbnail'] = 'images/thumbnail/' . $photo['_id'] . '.' . $photo['type'];
        $photo['path_watermark'] = 'images/watermark/' . $photo['_id'] . '.' . $photo['type'];
        if(!empty($_REQUEST['title'])) {
            $photo['title'] = filter_var($_REQUEST['title'], FILTER_SANITIZE_STRING);
        }
        if(!empty($_REQUEST['author'])) {
            $photo['author'] = filter_var($_REQUEST['author'], FILTER_SANITIZE_STRING);
        }
        move_uploaded_file($file['tmp_name'], $photo['path_orig']);
        createThumbnail($photo['path_orig'], $photo['path_thumbnail'], $photo['type']);
        createImageWithWatermark($photo['path_orig'], $photo['path_watermark'], $photo['type'], $photo['watermark']);
        
        // add information about photo to database and check if id is not repeated
        $db = getDB();
        if (!empty($_REQUEST['privacy']) && $_REQUEST['privacy'] == "private") {
            $user = ($db->users->find(['login' => $_SESSION['username']])->toArray())[0];
            if (empty($user['photos']))
                $photos = [];
            else
                $photos = iterator_to_array($user['photos']);
            while (in_array($photo['_id'],  $photos))
                $photo['_id'] = new ObjectID();
            array_push($photos, $photo);
            $user['photos'] = $photos;
            $db->users->replaceOne(['login' => $_SESSION['username']], $user);
            
        }
        else {
            while (!empty($db->photos->findOne(['_id' => new ObjectID($photo['_id'])])))
                $photo['_id'] = new ObjectID();
            $db->photos->insertOne($photo);
        }
    }
    
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
