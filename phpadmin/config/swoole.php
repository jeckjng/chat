<?php

return array(
    'http' => array(
        'port' => 2025, // http监听端口
        'ssl_cert_file' => ROOT_PATH.'data/cert/classicdn.com.crt',
        'ssl_key_file' => ROOT_PATH.'data/cert/classicdn.com.key',
        'daemonize' => false, // 是否守护进程后台运行
    ),

    'socket' => array(
        'port' => 2026, // socket监听端口号
        'ssl_cert_file' => ROOT_PATH.'data/cert/classicdn.com.crt',
        'ssl_key_file' => ROOT_PATH.'data/cert/classicdn.com.key',
        'daemonize' => true, // 是否守护进程后台运行
    ),
);