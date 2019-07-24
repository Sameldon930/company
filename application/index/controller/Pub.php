<?php
namespace app\index\controller;
class  Pub{

    public $redis;

    public function __construct(){
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $this->redis = $redis;
    }

    public function index(){

        $msg = '我是漳州市';
        $res = $this->redis->publish('cctv',$msg);
        var_dump($res);
    }

    public function zzs(){
        $msg = 'hello';
        $ret = $this->redis->publish('cctv',$msg);
        var_dump($ret);
    }
}
