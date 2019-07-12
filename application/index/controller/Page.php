<?php
namespace app\index\controller;

use think\Controller;

class Page extends  Common {
    public function page()
    {
        return $this->fetch();
    }
}
