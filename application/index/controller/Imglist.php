<?php
namespace app\index\controller;

use think\Controller;

class Imglist extends  Common {
    public function imglist()
    {
        return $this->fetch();
    }
}
