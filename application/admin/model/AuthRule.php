<?php
namespace  app\admin\model;

use think\Model;

class  AuthRule extends  Model{

    protected static function init()
    {
        AuthRule::event('before_delete',function(){
            return false;
        });
    }
    //结构排序
    public function ruleTree(){
        $ruleres = $this->order('sort desc')->select();
        return $this->sort($ruleres);

    }

    /**
     * @param $data       所有权限
     * @param int $pid    上级id
     * @param int $level  0一级权限 1二级权限 2三级权限 以此类推
     *
     */
    public function sort($data,$pid=0){
        static $arr = array();
        foreach($data as $k=>$v){
            //找出顶级权限
            if($v['pid'] == $pid ){
                $arr[] = $v;
                //继续递归下级权限 以此类推
                $this->sort($data,$v['id']);
            }
        }
        return $arr;
    }



    /**
     * @param $cateId 权限id
     * 根据id获取下级权限
     */
    public function getChildren($ruleId){
        //获取所有权限
        $ruleres = $this->select();
        return $this->_getChildren($ruleres,$ruleId);
    }

    /**
     * @param $data 所有权限
     * @param $ruleId  权限id
     * 递归获取
     */
    public function _getChildren($data,$ruleId){
        static  $arr = [];
        foreach ($data as $key =>$val){
            //如果权限的pid等于传过来的cateId 那就是所传的id的子权限
            if($val['pid'] == $ruleId){
                $arr[] = $val['id'];
                $this->_getChildren($data,$val['id']);
            }
        }
        return $arr;

    }
}