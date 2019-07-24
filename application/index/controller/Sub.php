<?php
namespace app\index\controller;
class  Sub{

    public function index(){
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $res = $redis->subscribe(['cctv'],function($redis,$chan,$msg){
            var_dump($redis);
            var_dump($chan);
        });
        var_dump($res);

    }
}
