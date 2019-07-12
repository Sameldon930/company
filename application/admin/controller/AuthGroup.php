<?php
namespace app\admin\controller;

use think\Controller;

class AuthGroup extends Base {

    public function index(){
        $auth_groups = model('AuthGroup')->paginate(15);
        return $this->fetch('auth_group/lists',[
            'auth_groups'=>$auth_groups
        ]);
    }
    public function  add(){
        if(request()->isPost()){
            $data = input('post.');
            $res = db('auth_group')->insert($data);
            if($res){
                $this->success('添加成功！','auth_group/index');
            }else{
                $this->error('添加失败！');
            }
        }
        return $this->fetch('');
    }
    public function edit($id){
        $info = model('AuthGroup')->where('id='.$id)->find();
        if(request()->isPost()){
            $data = input('post.');
            if(!@$data['status']) {//如果状态从启动改为禁用  接收不到status值
                $data['status'] = 0;
            }
            $res = model('auth_group')->save($data,['id'=>$data['id']]);
            if($res){
                $this->success('编辑成功！','auth_group/index');
            }else{
                $this->error('编辑失败！');
            }


        }
        return $this->fetch('',[
            'info'=>$info
        ]);
    }

    public function delete($id){
        $res = model('AuthGroup')->where('id='.$id)->delete();
        if($res){
            $this->success('删除成功！','auth_group/index');
        }else{
            $this->error('删除失败！');
        }
    }

}
