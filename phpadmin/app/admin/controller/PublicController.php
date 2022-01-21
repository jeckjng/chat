<?php
namespace app\admin\controller;

class PublicController extends AdminController
{
    public function login(){
        echo json_encode(getparam())."\n";



        $this->assign([
            'msg'=>'进入login',
            ]);
        return $this->fetch();
    }

}
