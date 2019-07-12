<?php
namespace app\index\controller;

use think\Controller;

class Common extends  Controller{

    public function _initialize()
    {
        $confs = model('Conf')->getAllConf();
        $confres = array();
        foreach ($confs as $k=>$v){
            $confres[$v['enname']] = $v['cnname'];
        }
        $this->fetch('',[
            'confres'=>$confres
        ]);
    }
}
