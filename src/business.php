<?php
//
// Created by Tomasz Piechocki. 18/12/18
//

use MongoDB\BSON\ObjectID;

// functions connected with uploading, like file transtitions and file check
require_once "business/file_upload.php";

function getDB() {
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function getAllPhotos($page, &$number_of_pages) {
    $photosPerPage = 6;
    $db = getDB();
    $number_of_pages = ceil($db->photos->count()/$photosPerPage);
    $filter = [];
    $options = ['sort' => ['path_orig' => 1],
        'limit' => $photosPerPage,
        'skip' => ($page-1)*$photosPerPage,
    ];
    return $db->photos->find($filter, $options)->toArray();
}
function getOnePhoto($id, &$position) {
    $db = getDB();
    if(preg_match('/^[0-9a-f]{24}$/i', $id) === 1) {
        $photo = $db->photos->findOne(['_id' => new ObjectID($id)]);
        $position = count($db->photos->find(['path_orig' => ['$lt' => $photo['path_orig']]])->toArray())+1;
        $position = ceil($position/6);
        return $photo;
    }
    else
        return NULL;
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
        'author' => "Anonim"
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

    // add information about photo to database
    $db = getDB();
    $db->photos->insertOne($photo);
}

// remove files connected to photo of this id and remove from database
function removePhoto($id) {
    $db = getDB();
    $photo = $db->photos->findOne(['_id' => new ObjectID($id)]);
    unlink($photo['path_orig']);
    unlink($photo['path_thumbnail']);
    unlink($photo['path_watermark']);
    $db->photos->deleteOne(['_id' => new ObjectID($id)]);
}

// validate form and upload photo
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
            $check_status = checkPhoto($_FILES['photo'], $model);
        }
        if (!empty($_FILES['photo']['name'] && !empty($_REQUEST['watermark']))) {
            if ($check_status) {
                addPhoto($_FILES['photo']);
                return 'redirect:gallery';
            }
        }
    }
    return 'gallery_view';
}

