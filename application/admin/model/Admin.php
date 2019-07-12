<?php
namespace  app\admin\model;

use think\Model;

class  Admin extends  Model{

    //添加
    public  function  addadmin($data){
        if(empty($data) || !is_array($data)){
            return false;
        }
        if($data['password']){
            $data['password'] = md5($data['password']);
        }
        if($this->save($data)){
            return true;
        }else{
            return false;
        }

    }
    //获取列表
    public  function getAdmins(){
        return $this::paginate(5);
    }
    //根据id获取对应的信息
    public function  getAdminInfo($id){
        return $this->where('id='.$id)->find();
    }

    //更新id对应的数据
    public function  updateInfo($data){
        $data = [
          'id'=>$data['id'],
          'name'=>$data['name'],
          'password'=>md5($data['password'])
        ];
        return $this->update($data,['id'=>$data['id']]);
    }

    //删除管理员
    public function deleteInfo($id){
        return $this->where('id='.$id)->delete();
    }
}