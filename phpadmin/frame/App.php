<?php
namespace frame;

use app\base\httpserver;

class App
{
    public static function run()
    {
        httpserver::run();
    }

}