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
            $service=$request->get['service'];
            setparam($request->server['request_method'],$request);

            try {
                // 接口响应
                list($className, $method_name) = explode('.', $service);

                $apiClassName = '\app\admin\controller\\'.ucfirst($className).'Controller';

                if(!class_exists($apiClassName)){
                    $data = '控制器不存在';
                    throw new \Exception($data);
                }
                $object = new $apiClassName();
                if(!method_exists ($object,$method_name)){
                    $data = '方法不存在';
                    throw new \Exception($data);
                }
                $data = call_user_func(array($object, $method_name));
            }catch (\Exception $e){
                $data = $e->getMessage();
            }
            $response->end($data);
        });
        $http->start();
    }


}