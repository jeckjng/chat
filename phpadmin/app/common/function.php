<?php

/*
 * 获取配置文件
 * */
function config($name){
    return \app\base\Config::instance()->get($name);
}

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting, so let it fall
        // through to the standard PHP error handler
        return false;
    }

    switch ($errno) {
        case E_USER_ERROR:
            echo "ERROR [$errno] [$errfile:$errline] $errstr\n";
            break;

        case E_USER_WARNING:
            echo "WARNING [$errno] [$errfile:$errline] $errstr\n";
            break;

        case E_USER_NOTICE:
            echo "NOTICE [$errno] [$errfile:$errline] $errstr\n";
            break;

        default:
            echo "UNKNOWN [$errno] [$errfile:$errline] $errstr\n";
            break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

function exceptionHandler(Throwable $e)
{
    if ($e instanceof Error) {
        echo "catch Error: " . $e->getCode() . '   ' . $e->getMessage() . '<br>';
    } else {
        echo "catch Exception: " . $e->getCode() . '   ' . $e->getMessage() . '<br>';
    }
}