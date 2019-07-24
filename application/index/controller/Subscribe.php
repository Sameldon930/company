<?php
namespace app\index\controller;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class  Subscribe extends  Command {

    public function index(){
        //设置命令选项
        $this->setName('subscribe')->setDescription('接收订阅信息');
    }
    protected  function execute(Input $input, Output $output)
    {
        $redis = new  \Redis();
        $redis->pconnect('127.0.0.1',6379);
        $result = $redis->psubscribe(['cctv:*'],function ($redis,$chan,$msg){
           var_dump($chan,$msg);
        });
    }
}
