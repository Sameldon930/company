<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Base extends Controller{
    public function  _initialize()
    {
        if(!session('login_admin')){
            $this->error('尚未登陆系统！',url('login/index'));
        }

        /****************************auth验证************************/
        $auth = new Auth();
        //检查权限
        //获取要访问时候的控制器和方法是否在权限范围内
        $request = Request::instance();
        $con = $request->controller();//控制器
        $action = $request->action();//方法
        $rule_name = $con.'/'.$action;
        $noCheck = array('Index/index','Admin/lists','Login/logout');//控制器大写
        //不是超级管理员就需要验证 否则不用验证
        if(session('login_admin')->id != 1){
            if(!in_array($rule_name,$noCheck)){//如果方法名和控制器名字不在不需要检查的数组中 再进行检查
                if(!$auth->check($rule_name,session('login_admin')->id)){
                    $this->error('该管理员没有访问的权限！','index/index');
                }
            }
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