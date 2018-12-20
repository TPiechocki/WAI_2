<?php
//
// Created by Tomasz Piechocki. 18/12/18
//
require_once "business/file_upload.php";


function getDB()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function uploadPhoto(&$model) {
    $model['error'] = NULL;
    $check_status = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_FILES['photo']['name'])) {
            $model['error']['nophoto']['info'] = "Musisz dodać zdjęcie.";
        }
        if (empty($_REQUEST['watermark'])) {
            $model['error']['nowatermark']['info'] = "Musisz dodać treść znaku wodnego.";
        }
        if (!empty($_FILES['photo']['name'])) {
            $check_status = checkFile($_FILES['photo'], $model);
        }
        if (!empty($_FILES['photo']['name'] && !empty($_REQUEST['watermark']))) {
            $uploaded_photo = [
                'photo' => $_FILES['photo'],
            ];
            if ($check_status) {
                savePhoto($uploaded_photo);
                return 'redirect:gallery';
            }
        }
    }
    return 'gallery_view';
}