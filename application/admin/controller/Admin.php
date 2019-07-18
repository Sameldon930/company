<?php
namespace app\admin\controller;

use think\Controller;

class Admin extends  Base {

    //列表页
    public function lists(){
        $auth = new Auth();
        //获取所有的管理员
        $list =  model('Admin')->getAdmins();
        foreach($list as $k => $v){
            //获取所有分组得到分组名 然后拼接到管理员的数组中
            $_groupTitle = $auth->getGroups($v['id']);
            if($_groupTitle){
                $groupTitle = $_groupTitle[0]['title'];
                $v['group_name'] = $groupTitle;
            }
        }
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
            $groups = model('AuthGroup')->select();
            return $this->fetch('',[
                'groups'=>$groups
            ]);
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
            $info = model('Admin')->getAdminInfo($id);//获取当前管理员信息
            $groups = model('AuthGroup')->select();//获取所有分组
            //获取管理员对应的分组id
            $access = db('AuthGroupAccess')->where('uid='.$id)->find();
            if(!$info){
                $this->error('管理员不存在！');
            }
            return $this->fetch('',[
                'info'=>$info,
                'groups'=>$groups,
                'access'=>$access['group_id']

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
