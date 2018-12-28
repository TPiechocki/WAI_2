<?php
//
// Created by Tomasz Piechocki. 13/12/18
//

require_once 'business.php';

function gallery(&$model) {
    if (empty($_REQUEST['page']))
        $page_number = 1;
    else
        $page_number = $_REQUEST['page'];
    $model['page_number'] = $page_number;
    if ($page_number > 1)
        $model['previous_page'] = $page_number - 1;
    if (true)
        $model['next_page'] = $page_number + 1;
    $number_of_pages = NULL;
    $model['photos'] = getAllPhotos($page_number, $number_of_pages);
    $model['number_of_pages'] = $number_of_pages;
    $status = uploadPhoto($model);     // check if photo was uploaded and show gallery with redirect or not
    return $status;
}
function remove(&$model) {
    if (!empty($_REQUEST['id'])) {
        removePhoto($_REQUEST['id']);
    }
    return 'redirect:gallery';
}

function photo(&$model) {   // display one photo
    if (empty($_REQUEST['id']))     // if there's no photo id in GET request
        return 'redirect:gallery';
    // else
    $model['photo'] = getOnePhoto($_REQUEST['id'], $model['position']);
    if (empty($model['photo']))
        return 'redirect:gallery';
    //else
    return 'photo_view';

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

