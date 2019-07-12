<?php
namespace app\admin\controller;

use think\Controller;

class Conf extends Base {

    //配置列表
    public function  index(){
        $lists = model('Conf')->order('sort desc')->paginate(5);
        return $this->fetch('conf/lists',[
            'lists'=>$lists
        ]);
    }
    //配置列表的添加
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            if($data['values']){//中文逗号 替换成英文逗号
                $data['values']  = str_replace('，',',',$data['values']);
            }
            $validate = validate('Conf');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $res = model('Conf')->save($data);
            if($res){
                $this->success('添加成功！','conf/index');
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch('');
    }
    //配置列表的编辑
    public function  edit($id){
        $info = model('Conf')->where('id='.$id)->find();
        if(request()->isPost()){
            $data = input('post.');
            if($data['values']){//中文逗号 替换成英文逗号
                $data['values']  = str_replace('，',',',$data['values']);
            }
            $res = model('Conf')->save($data,['id'=>$data['id']]);
            if($res){
                $this->success('编辑成功！','conf/index');
            }else{
                $this->error('编辑失败');
            }
        }
        return $this->fetch('',[
            'info'=>$info
        ]);
    }
    //配置例表的删除
    public function delete($id){
        $res = model('Conf')->where('id='.$id)->delete($id);
        if($res){
            $this->success('删除成功！','conf/index');
        }else{
            $this->error('删除失败！');
        }
    }

    /********************************/

    //配置项
    public function conf(){
        $confs = model('Conf')->order('sort desc')->select();
        if(request()->isPost()){
            $data = input('post.');
            $form = array();//初始化数组 然后将data的内容存到这个数组中
            foreach($data as $k1=>$v1){
                $form[] = $k1;
            }
            //取出所有的enname
            $arr = db('conf')->field('enname')->select();
            $confarr = array();
            foreach($arr as $k2=>$v2){//将所有的enname存放到一个数组中
                $confarr[] = $v2['enname'];
            }
            //遍历上面的数组
            foreach($confarr as $k3 => $v3 ){//遍历数组 将$form ， $confarr 这两个数组进行比较
                if(!in_array($v3,$form)){//判断有没有enname不存在数组中 如果不存在就
                    $checkbox[] = $v3;
                }
            }
            if($checkbox){//如果存在这个 就将对应的值清空
                foreach ($checkbox as $v4){
                    model('Conf')->where('enname',$v4)->update(['value'=>'']);
                }

            }
            //组织成一维数组
            if($data){
                //更新数据
                foreach ($data as $k=>$v){
                    model('Conf')->where('enname',$k)->update(['value'=>$v]);
                }
                $this->success('更新成功!','conf/conf');
            }

        }
        return $this->fetch('',[
            'confs'=>$confs
        ]);
    }
}
