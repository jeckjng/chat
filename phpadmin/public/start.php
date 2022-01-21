<?php

define('debug', true);

/*
 * frame
 * */
require_once __DIR__ . '/../frame/Loader.php';
/*
 * vendor
 * */
//require_once __DIR__ . '/../vendor/autoload.php';
/*
 * config
 * */
foreach(glob(__DIR__.'/../config/*.php') as $start_file){
    require_once $start_file;
}


// 执行应用
\frame\App::run();

