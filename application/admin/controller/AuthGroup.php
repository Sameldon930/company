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
            if($data['rules']){
                $data['rules'] = implode(',',$data['rules']);
            }
            $res = db('auth_group')->insert($data);
            if($res){
                $this->success('添加成功！','auth_group/index');
            }else{
                $this->error('添加失败！');
            }
        }
        //从rule表中获取所有权限
        $rules = model('AuthRule')->ruleTree();
        return $this->fetch('',[
            'rules'=>$rules
        ]);
    }
    public function edit($id){
        $info = model('AuthGroup')->where('id='.$id)->find();
        //从rule表中获取所有权限
        $rules = model('AuthRule')->ruleTree();
        if(request()->isPost()){
            $data = input('post.');
            if($data['rules']){
                $data['rules'] = implode(',',$data['rules']);
            }
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
            'info'=>$info,
            'rules'=>$rules
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
