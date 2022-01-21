<?php
namespace app\base;

//use app\base\Singleton;

class Config
{
//    use Singleton;

    private static $instance;

    public static function instance(...$args)
    {
        if(!isset(self::$instance)){
            self::$instance = new static(...$args);
        }
        return self::$instance;
    }

    public function get($name){
        $name = strtolower($name);
        $arrt = false;
        if (!strpos($name, '.')) {
            // 非二级配置时
            $file = CONF_PATH .'../config' . DS . $name . CONF_EXT;
        }else{
            $arrt = true;
            // 二维数组设置和获取支持
            $name    = explode('.', $name, 2);
            $name[0] = strtolower($name[0]);
            $file = CONF_PATH .'../config' . DS . $name[0] . CONF_EXT;
        }

        if(!is_file($file)){
            return null;
        }
        $config = include $file;

        // 非二级配置时直接返回
        if ($arrt === false) {
            return $config;
        }

        return isset($config[$name[1]]) ? $config[$name[1]] : null;
    }


}