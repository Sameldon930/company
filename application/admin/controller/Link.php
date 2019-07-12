<?php
namespace app\admin\controller;

use think\Controller;

class Link extends Base {

    //列表页
    public function index()
    {
        $links = model('Link')->order('sort desc')->paginate(2);
        return $this->fetch('link/lists',[
            'links'=>$links
        ]);
    }
    //编辑
    public function edit($id){
        $info = model('Link')->where('id='.$id)->find();
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('Link');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $res = model('Link')->save($data,['id'=>$data['id']]);
            if($res){
                $this->success('修改链接成功！','Link/index');
            }else{
                $this->error('修改失败！');
            }
        }
        return $this->fetch('',[
            'info'=>$info
        ]);

    }
    //添加
    public function  add(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('Link');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $res = model('Link')->save($data);
            if($res){
                $this->success('添加链接成功！','link/index');
            }else{
                $this->error('添加失败！');
            }
        }else{
            return $this->fetch('');
        }

    }
    //删除
    public function delete($id){
        $res = model('Link')->where('id='.$id)->delete();
        if($res){
            $this->success('删除成功！','Link/index');
        }else{
            $this->error('删除失败！');
        }
    }
}
