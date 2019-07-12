<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Article extends Base {

    //文章列表页
    public function index()
    {

        $lists =  Db::table('c_article')
            ->field('a.*,c.catename')
            ->alias('a')
            ->join('c_cate c','a.cateid = c.id','LEFT')
            ->paginate(5);
        return $this->fetch('article/lists',[
            'lists'=>$lists
        ]);
    }

    //文章添加
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('Article');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            //利用钩子函数也就是事件函数在模型层上处理上传图片
            $res = model('Article')->save($data);
            if($res){
                $this->success('添加成功！','article/index');
            }else{
                $this->error('添加失败！');
            }
        }
        //获取所有栏目
        $cates =  model('Cate')->cateTree();
        return $this->fetch('',[
            'cates'=>$cates
        ]);
    }

    //文章编辑
    public function  edit($id){
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('Article');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $res = model('Article')->save($data,['id'=>$data['id']]);
            if($res){
                $this->success('编辑成功！','article/index');
            }else{
                $this->error('编辑失败！');
            }
        }
        $info = model('Article')->where('id='.$id)->find();
        //获取所有栏目
        $cates =  model('Cate')->cateTree();
        return $this->fetch('',[
            'cates'=>$cates,
            'info'=>$info
        ]);
    }

    //文章删除
    public function  delete($id){
        $res = model('Article')->where('id='.$id)->delete();
        if($res){
            $this->success('删除成功！','article/index');
        }else{
            $this->error('删除失败！');
        }
    }
}
