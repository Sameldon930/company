<?php
namespace app\admin\controller;

use think\Controller;

class Admin extends  Base {

    //列表页
    public function lists(){

       $list =  model('Admin')->getAdmins();
        return $this->fetch('',[
            'lists'=>$list
        ]);

    }
    //添加管理员
    public function add()
    {
        //如果是post方式访问 就是添加 否则只是访问页面
        if(request()->isPost()){
            $data = input('post.');
            $res = model('Admin')->addadmin($data);
            if($res){
                $this->success('添加管理员成功！','admin/lists');
            }else{
                $this->error('添加管理员失败！');
            }
        }else{
            return $this->fetch();
        }


    }
    //编辑 函数
    public function edit($id){
        if(request()->isPost()){
            $data = input('post.');
            $res = model('Admin')->updateInfo($data);
            if($res){
                $this->success('更新成功！','admin/lists');
            }else{
                $this->error('更新失败！');
            }

        }else{
            $info = model('Admin')->getAdminInfo($id);
            if(!$info){
                $this->error('管理员不存在！');
            }
            return $this->fetch('',[
                'info'=>$info
            ]);
        }



    }
    //删除管理员
    public function  delete($id){
        $res = model('Admin')->deleteInfo($id);
        if($res){
            $this->success('删除成功！','admin/lists');
        }else{
            $this->error('删除失败！');
        }
    }


}
