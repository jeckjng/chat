<?php

require_once __DIR__ . '/Base.php';
//require_once __DIR__ . '/Connect.php';
//require_once __DIR__ . '/Db.php';
require_once __DIR__ . '/App.php';

/*
 * mysql
 * */
foreach(glob(__DIR__.'/mysql/*.php') as $start_file){
//    require_once $start_file;
}

/*
 * app
 * */
foreach(glob(__DIR__.'/../app/common/*.php') as $start_file){
    require_once $start_file;
}
foreach(glob(__DIR__ . '/../app/admin/controller/*.php') as $start_file){
    require_once $start_file;
}
foreach(glob(__DIR__.'/../app/base/*.php') as $start_file){
    require_once $start_file;
}