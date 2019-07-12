<?php
namespace app\admin\controller;

use think\captcha\Captcha;
use think\Controller;

class Login extends Controller{

    public function index()
    {
        return $this->fetch('login/login');
    }

    //登陆验证
    public function loginCheck(){
        if(!request()->post()){
            $this->error('非法请求！');
        }else{
            $this->check(input('code'));
            $data = input('post.');
            $validate = validate('Admin');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            //检查验证码

            //根据名称 查看是否有这个人 如果没有提示错误 如果有 判断密码是否正确
            $info = model('Admin')->getByName($data['name']);
            if($info){
                if($info['password'] != md5($data['password'])){
                    $this->error('密码输入错误！');
                }
                session('login_admin',$info);//可以用于验证是否登陆 后台头部的身份切换
                $this->success('登陆成功！','index/index');

            }else{
                $this->error('不存在该管理员！');

            }
        }

    }

    //退出登陆
    public function  logout(){
        session('login_admin',null);
        $this->success('退出成功!','login/index');
    }

    //检验验证码
    public function check($code=''){
        if(!captcha_check($code)){
            $this->error('验证码错误！');
        }else{
            return true;
        }
    }

//    public function  test(){
//        $data = [
//            'id'=>1,
//            'name'=>'zzs'
//        ];
//        return json_encode($data);
//    }
}
