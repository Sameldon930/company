<?php
namespace app\index\model;

use think\Model;

class Conf extends Model{

    //获取所有配置项
    public function getAllConf(){
        $confs = $this::field('enname,cnname')->select();
        return $confs;
    }
}