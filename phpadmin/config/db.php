<?php

return array(
    'mysql' => array(
        'hostname' => '127.0.0.1', // 服务器地址
        'database' => 'yunqianbao', // 数据库名
        'username' => 'root', // 用户名
        'password' => '3#SoGjjMR5jmNQFo', // 密码
        'hostport' => '3306', // 端口
        'charset'  => 'utf8mb4', // 数据库编码默认采用utf8
        'prefix'   => 'chat_', // 数据库表前缀
        "authcode" => 'JOw9vBG5HRW1uMaU4I', // 加密串
    ),
    'redis' => array(
        'host' => '127.0.0.1', // 服务器地址
        'port' => 6379, // 端口
        'password' => '123456', // 密码
        'cachedb' => '0', // 缓存使用
    ),
);