<?php
namespace app\base;

//use app\admin\controller\PublicController;

class Httpserver
{
    public function run(){
        $dbconf = config('db');
        $swooleconf = config('swoole.http');
//        echo json_encode($dbconf)."\n\n";
//        echo json_encode($swooleconf)."\n\n";

        $http = new \swoole_http_server('0.0.0.0',$swooleconf['port']);
        $http->set([
            'worker_num'=>1,
            'max_request'=>100000,
            'daemonize'  => $swooleconf['daemonize'],
            'buffer_output_size' => 32 * 1024 * 1024,
            'package_max_length'    => 1000000000,
            'enable_static_handler' => true,
            'document_root' => ROOT_PATH,
            'log_file'=> LOG_PATH."swoole_http_server_log.txt",
        ]);
        $http->on('workerStart', function (\swoole_server $server, int $worker_id) {
            echo "worker_id: ".$worker_id." \n";
            set_error_handler("myErrorHandler", E_ALL | E_STRICT);
            set_exception_handler('exceptionHandler');
        });

        // 定时器
        $process = new \Swoole\Process(function($process) use ($http) {
            $dbconn = '';
            $http->tick(6000, function() use ($dbconn) {
//                echo "定时器 \n";
            });
        });
        $http->addProcess($process);

        $http->on('start',function (\swoole_server $server){
            echo "服务器启动了！\n";
        });

        $http->on('request',function (\swoole_http_request $request,\swoole_http_response $response) {
            $response->header("Content-Type", "text/html; charset=utf-8");
            $method=strtolower($request->server['request_method']);
            $service=$request->get['service'];

            echo "请求方式：".$method."\n";
            echo "service：".$service."\n";

            try {
                // 接口响应
                list($className, $action) = explode('.', $service);

                $apiClassName = '\app\admin\controller\\'.ucfirst($className).'Controller';
                $api = new $apiClassName();
                $data = call_user_func(array($api, $action));

                echo $data;
            }catch (\Exception $e){
                echo "出错了：".$e."\n";
                throw $e;
            }

        });
        $http->start();
    }


}