<?php
//
// Created by Tomasz Piechocki. 13/12/18
//

require_once 'business.php';

function gallery(&$model) {
    $photos_per_page = 6;
    if (empty($_REQUEST['page']))
        $page_number = 1;
    else
        $page_number = $_REQUEST['page'];
    $model['page_number'] = $page_number;
    
    if ($page_number > 1)
        $model['previous_page'] = $page_number - 1;
    if (true)
        $model['next_page'] = $page_number + 1;
    
    $model['photos'] = getAllPhotos();
    
    $model['photos'] = sortByDate($model['photos']);
    $number_of_pages = ceil(count($model['photos'])/$photos_per_page);
    $model['number_of_pages'] = $number_of_pages;
    if ($number_of_pages == 0)
        $model['page_number'] = 0;
    
    // get only photos for proper page
    $model['photos'] = array_slice($model['photos'], $photos_per_page*($page_number-1), $photos_per_page);
    return 'gallery_view';
}
function upload(&$model) {
    return uploadPhoto($model);     // check if photo was uploaded and show gallery with redirect or not
}
function remove() {
    if (!empty($_REQUEST['id'])) {
        removePhoto($_REQUEST['id']);
    }
    return 'redirect:gallery';
}

function saveChoice() {
    if (empty($_SESSION['picked_ids'])) {
        $_SESSION['picked_ids'] = [];
    }
    if (!empty($_POST['checked'])) {
        foreach ($_POST['checked'] as $photo) {
            if (in_array($photo, $_SESSION['picked_ids']) == false) {
                array_push($_SESSION['picked_ids'], $photo);
            }
        }
    }
    return 'redirect:gallery?page=' . $_GET['page'];
}
function removeChoice() {
        if ($_SESSION['picked_ids'] == NULL) {
            $_SESSION['picked_ids'] = [];
        }
        if (!empty($_POST['checked'])) {
            foreach ($_POST['checked'] as $photo) {
                // get the key of every chosen photo id and remove it from array
                if (($key = array_search($photo, $_SESSION['picked_ids'])) !== false) {
                    unset($_SESSION['picked_ids'][$key]);
                }
            }
        }
        
        // reorder array so there are no missing indexes
        $_SESSION['picked_ids'] = array_values($_SESSION['picked_ids']);
        return 'redirect:picked?page=' . $_GET['page'];
    }
function pickedPhotos(&$model) {
    $photos  = [];
    if (!empty($_SESSION['picked_ids'])) {
        foreach ($_SESSION['picked_ids'] as $photo_id) {
            $photo = getOnePhoto($photo_id);       // position do nothing here
            array_push($photos, $photo);
        }
    }
    $photos = sortByDate($photos);
    
    $photos_per_page = 6;
    if (empty($_REQUEST['page']))
        $page_number = 1;
    else
        $page_number = $_REQUEST['page'];
    $model['number_of_pages'] = ceil(count($photos)/$photos_per_page);
    if ($model['number_of_pages'] < $page_number)
        $page_number = $model['number_of_pages'];
    $model['page_number'] = $page_number;
    if ($page_number > 1)
        $model['previous_page'] = $page_number - 1;
    if (true)
        $model['next_page'] = $page_number + 1;
    
    $model['photos'] =  array_slice($photos, $photos_per_page*($page_number-1), $photos_per_page);
    return 'picked_photos_view';
}

function photo(&$model) {   // display one photo
    if (empty($_REQUEST['id']))     // if there's no photo id in GET request
        return 'redirect:gallery';
    // else
    $model['photo'] = getOnePhoto($_REQUEST['id']);
    if (empty($model['photo']))
        return 'redirect:gallery';
    //else
    return 'photo_view';
}

function register(&$model) {
    // form handling
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (insertUser($model)) {       // validate data and insert user to database
            return 'redirect:gallery';
        }
        else
            return 'register_view';
    }
    return 'register_view';
}
function logIn(&$model) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (checkLogIn($model)) {
            return 'redirect:logged';
        }
        else
            gallery($model);
    }
    return gallery($model);
}
function logged(&$model) {
    $model['logged'] = "Pomyślnie zalogowano";
    return gallery($model);
}
function logOut() {
    // log out handling
    $_SESSION['user_id'] = NULL;
    $_SESSION['username'] = NULL;
    $_SESSION['usergroup'] = NULL;
    session_regenerate_id();
    return 'redirect:gallery';
}

function searchPhotos() {
    return 'search_view';
}
function searchResult(&$model) {
    $photos_per_page = 6;
    if (empty($_REQUEST['page']))
        $page_number = 1;
    else
        $page_number = $_REQUEST['page'];
    $model['page_number'] = $page_number;
    
    if ($page_number > 1)
        $model['previous_page'] = $page_number - 1;
    if (true)
        $model['next_page'] = $page_number + 1;
    $model['photos'] = [];
    
    $photos = getAllPhotos();
    $str = strtolower($_GET['str']);
    if (!empty($str)) {
        foreach ($photos as $photo) {
            $title = strtolower($photo['title']);
            if (strpos($title, $str) !== false) {
                array_push($model['photos'], $photo);
            }
        }
    }
    $model['photos'] = sortByDate($model['photos']);
    $number_of_pages = ceil(count($model['photos'])/$photos_per_page);
    $model['number_of_pages'] = $number_of_pages;
    if ($number_of_pages == 0)
        $model['page_number'] = 0;
    
    // get only photos for proper page
    $model['photos'] = array_slice($model['photos'], $photos_per_page*($page_number-1), $photos_per_page);
    return 'partial/search_result_view';
}

function mainPage() {
    return 'main_page_view';
}
function famous() {
    return 'famous_view';
}
function sailingPL() {
    return 'sailing_PL_view';
}
function contact() {
    return 'contact_view';
}
function contactInfo() {
    return 'contact_info_view';
}

