<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller{
    public function  _initialize()
    {
        if(!session('login_admin')){
            $this->error('尚未登陆系统！',url('login/index'));
        }
    }

    //列表排序
    public function  order(){
        if(!request()->isPost()){
            $this->error('请求错误！');
        }
        $model = request()->controller();
        $sort = input('post.');
        foreach ($sort as $k => $v){
            model($model)->update(['id'=>$k,'sort'=>$v]);
        }
        $this->success('排序成功！');
    }
}