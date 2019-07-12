<?php
namespace  app\admin\model;

use think\Model;

class  Cate extends  Model{

    protected static function init()
    {
        Cate::event('before_delete',function(){
            return false;
        });
    }
    //结构排序
    public function cateTree(){
        $cateres = $this->order('sort desc')->select();
        return $this->sort($cateres);

    }

    /**
     * @param $data       所有栏目
     * @param int $pid    上级id
     * @param int $level  0一级栏目 1二级栏目 2三级栏目 以此类推
     *
     */
    public function sort($data,$pid=0,$level=0){
        static $arr = array();
        foreach($data as $k=>$v){
            //找出顶级栏目
            if($v['pid'] == $pid ){
                $v['level'] = $level;
                $arr[] = $v;
                //继续递归下级栏目 以此类推
                $this->sort($data,$v['id'],$level+1);
            }
        }
        return $arr;
    }

    /**
     * @param $cateId 栏目id
     * 根据id获取下级栏目
     */
    public function getChildren($cateId){
        //获取所有栏目
        $cateres = $this->select();
        return $this->_getChildren($cateres,$cateId);
    }

    /**
     * @param $data 所有栏目
     * @param $pid  栏目id
     * 递归获取
     */
    public function _getChildren($data,$cateId){
        static  $arr = [];
        foreach ($data as $key =>$val){
            //如果栏目的pid等于传过来的cateId 那就是所传的id的子栏目
            if($val['pid'] == $cateId){
                $arr[] = $val['id'];
                $this->_getChildren($data,$val['id']);
            }
        }
        return $arr;

    }



}