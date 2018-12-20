<?php
//
// Created by Tomasz Piechocki. 15/12/18
//
?>
<!doctype html>
<html lang="pl-PL">
    <head>
        <link rel="stylesheet" type="text/css" href="static/css/index.css" />
        <link rel="icon" href="static/img/favicon.ico" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="Tomasz Piechocki" />
        <title>Żeglarstwo</title>
    </head>
    <body>
        <header id="mainHeader">
            <img src="static/img/boat.svg" alt="żaglówka" id="mainHeaderimage" class="headerimage" />
            <h1>Żeglarstwo</h1>
        </header>
        <nav>
            <input type="radio" id="show" name="group" />
            <input type="radio" id="hide" name="group" />
            <label for="show" id="showMenu">Menu<span class="equiv">&equiv;</span></label>
            <label for="hide" id="hideMenu">Menu<span class="equiv">&equiv;</span></label>


            <ul id="menu">
                <li class="firstnav <?= ($page == 'main_page')? "active" : "" ?>"><a href="/">Strona Główna</a></li>
                <li <?= ($page == 'famous')? 'class = "active"' : "" ?>><a href="/famous">Znane żaglowce</a></li>
                <li class="withSubmenu <?= ($page == 'sailing_PL')? "active" : "" ?>">
                    <a href="/sailing_PL">Żeglarstwo w Polsce</a>
                    <ul class="submenu">
                        <li><a href="sailing_PL#lakes">Polske jeziora</a></li>
                        <li><a href="sailing_PL#yachts">Popularne jednostki</a></li>
                    </ul>
                </li>
                <li <?= ($page == 'gallery')? 'class = "active"' : "" ?>><a href="/gallery">Galeria</a></li>
                <li <?= ($page == 'contact')? 'class = "active"' : "" ?>><a href="contact">Kontakt</a></li>
            </ul>
        </nav>