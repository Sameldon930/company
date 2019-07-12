<?php
namespace app\index\controller;

use think\Controller;

class Article extends  Common {
    public function article()
    {
        return $this->fetch();
    }
}
