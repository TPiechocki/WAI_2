<?php
//
// Created by Tomasz Piechocki. 13/12/18
//

require_once 'business.php';

function gallery(&$model) {
    return uploadPhoto($model);
}
function mainPage() {
    return "main_page_view";
}
function famous() {
    return "famous_view";
}
function sailingPL() {
    return "sailing_PL_view";
}
function contact() {
    return "contact_view";
}
function contactInfo() {
    return "contact_info_view";
}

