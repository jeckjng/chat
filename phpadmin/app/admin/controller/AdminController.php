<?php
namespace app\admin\controller;

class AdminController
{
    private $data;

    public function __construct()
    {

    }

    public function assign($data=array()){
        $this->data = $data;
    }

    public function fetch(){
        $data = $this->data;
        $strdata = '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <title>Title</title>
                        <style>
                            span{
                                padding-left: 15px;
                                text-align: right;
                                width: 300px;
                            }
                            input{
                                width: 300px;
                            }
                        </style>
                        </head>
                        <body>
                            <form class="cust-js-ajax-form" action="$url" method="post" style="margin-bottom: 100px;">
                                <p><span>商户APPID（必填）</span><input type="text" name="pid" value="'.$data['msg'].'"> </p>
                                <p>
                                    <input type="submit" id="subbtn" value="提交">     
                                    <span class="payUrl"></span>
                                </p>
                            </form>
                        </body>
                        </html>
                        
                        <script >
                          
                        </script>';

        return $strdata;
    }

}
