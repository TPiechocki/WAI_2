<?php
//
// Created by Tomasz Piechocki. 18/12/18
//

use MongoDB\BSON\ObjectID;

// connect to database
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

// functions connected with uploading: file transtitions and file check
require_once "business/file_upload.php";

// returns all public photos and user's private photos
function getAllPhotos() {
    $photos1 = getPublicPhotos();
    if (!empty($_SESSION['username'])) {
        $photos2 = getPrivatePhotos();
        $photos = array_merge($photos1, $photos2);
    }
    else
        $photos = $photos1;
    return $photos;
}
// returns all public photos
function getPublicPhotos(/*$page, &$number_of_pages*/) {
    $db = getDB();
    /*$photosPerPage = 6;
    $number_of_pages = ceil($db->photos->count()/$photosPerPage);
    $filter = [];
    $options = ['sort' => ['date' => -1],
        'limit' => $photosPerPage,
        'skip' => ($page-1)*$photosPerPage,
    ];
    return $db->photos->find($filter, $options)->toArray();*/
    return $db->photos->find()->toArray();
}
// returns user's photo
function getPrivatePhotos() {
    $db = getDB();
    $user = ($db->users->find(['login' => $_SESSION['username']])->toArray())[0];
    $photos = iterator_to_array($user['photos']);
    foreach ($photos as $photo) {
        $photo['private'] = true;
    }
    return $photos;
}
// return photo with given id
function getOnePhoto($id) {
    $db = getDB();
    if (empty($_GET['private'])) {
        if (preg_match('/^[0-9a-f]{24}$/i', $id) === 1) {
            $photo = $db->photos->findOne(['_id' => new ObjectID($id)]);
            return $photo;
        } else
            return NULL;
    }
    else {
        if (preg_match('/^[0-9a-f]{24}$/i', $id) === 1) {
            $user = $db->users->findOne(['login' => $_SESSION['username']]);
            $photos = iterator_to_array($user['photos']);
            $key = array_search($id, array_column($photos, '_id'));
            $photos[$key]['private'] = true;
            return $photos[$key];
        } else
            return NULL;
    }
}

// remove files connected to photo of this id and remove from database
function removePhoto($id) {
    $db = getDB();
    if (preg_match('/^[0-9a-f]{24}$/i', $id) === 1) {
        if (empty($_GET['private'])) {
            $photo = $db->photos->findOne(['_id' => new ObjectID($id)]);
            $db->photos->deleteOne(['_id' => new ObjectID($id)]);
        } else {
            $user = $db->users->findOne(['login' => $_SESSION['username']]);
            $photos = iterator_to_array($user['photos']);
            $photos = array_values($photos);
            $key = array_search($id, array_column($photos, '_id'));
            $photo = $photos[$key];
            unset($photos[$key]);
            $user['photos'] = $photos;
            $db->users->replaceOne(['login' => $_SESSION['username']], $user);
        }
    }
    else
        return NULL;
    unlink($photo['path_orig']);
    unlink($photo['path_thumbnail']);
    unlink($photo['path_watermark']);
}

// validate registration form and enter to database if data is alright
function insertUser(&$model) {
    $email = $_POST['email'];
    $clean_email = filter_var($email,FILTER_SANITIZE_EMAIL);
    $login = $_POST['login'];
    $clean_login = filter_var($login,FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $clean_password = filter_var($password,FILTER_SANITIZE_STRING);
    $repeat_password = $_POST['repeat_password'];
    $db = getDB();
    $status = true;
    // validate email
    if (empty($email)) {
        $model['error']['email'] = "Email jest wymagany.";
        $status = false;
    }
    elseif ($email !== $clean_email || filter_var($email,FILTER_VALIDATE_EMAIL) == false) {
        $model['error']['email'] = "Email jest nieprawidłowy.";
        $status = false;
    }
    // validate login
    if (empty($login)) {
        $model['error']['login'] = "Login jest wymagany";
        $status = false;
    }
    elseif (strlen($login) < 5 || strlen($login) > 16) {
        $model['error']['login'] = "Login musi mieć 5-16 znaków.";
        $status = false;
    }
    elseif ($login !== $clean_login) {
        $model['error']['login'] = "Login jest nieprawidłowy.";
        $status = false;
    }
    else {
        $loginCheck = $db->users->findOne(['login' => $login]);
        if (!empty($loginCheck)) {
            $model['error']['login'] = "Login jest już zajęty";
            $status = false;
        }
    }
    // validate password
    if (empty($password)) {
        $model['error']['password'] = "Hasło jest wymagane.";
        $status = false;
    }
    elseif (strlen($password) < 8 || strlen($login) > 16) {
        $model['error']['password'] = "Hasło musi mieć 8-16 znaków.";
        $status = false;
    }
    elseif ($password !== $clean_password) {
        $model['error']['password'] = "Hasło jest nieprawidłowe.";
        $status = false;
    }
    if (empty($repeat_password)) {
        $model['error']['repeat_password'] = "Hasło musi być powtórzone.";
        $status = false;
    }
    elseif ($password !== $repeat_password) {
        $model['error']['repeat_password'] = "Powtórzone hasło jest inne niż orginalne.";
        $status = false;
    }
    
    $user['email'] = $email;
    $user['login'] = $login;
    $model['user'] = $user;
    if ($status === true) {
        $user['hash'] = password_hash($password, PASSWORD_DEFAULT);
        $user['group'] = "user";
        $db->users->insertOne($user);
    }
    
    return $status;
}
// validate log in
function checkLogIn(&$model) {
    $status = true;
    $db = getDB();
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    if (empty($login)) {
        $model['errorLogin']['login'] = "Login jest wymagany";
        $status = false;
    }
    if (empty($password)) {
        $model['errorLogin']['password'] = "Hasło jest wymagane.";
        $status = false;
    }
    if ($status === true) {
        $user = $db->users->findOne(['login' => $login]);
        if (password_verify($password, $user['hash']) === false) {
            $model['errorLogin']['wrongData'] = "Logowanie nie powiodło się.";
            $status = false;
        }
    }
    
    if ($status === true) {
        session_regenerate_id();
        $_SESSION['user_id'] = $user['_id'];
        $_SESSION['username'] = $user['login'];
        $_SESSION['usergroup'] = $user['group'];
    }
    return $status;
}

// sort photo array by date
function sortByDate($photos) {
    $dates = [];
    foreach ($photos as $photo) {
        array_push($dates, $photo['date']);
    }
    
    array_multisort($dates, SORT_DESC, $photos);
    
    return $photos;
}