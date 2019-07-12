<?php
namespace app\admin\controller;

use think\Controller;

class Cate extends Base {
    protected $beforeActionList = [
        //如果你执行的是delete这个方法 那就先执行查询他下级的方法
        'del_son'=>['only'=>'delete']
    ];
    //列表页
    public function index()
    {
        $cates = model('Cate')->cateTree();

        return $this->fetch('cate/lists',[
            'cates'=>$cates
        ]);
    }
    //编辑
    public function edit($id){
        $info = model('Cate')->where('id='.$id)->find();
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('Cate');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $res = model('Cate')->save([
                'pid'=>$data['pid'],
                'catename'=>$data['catename'],
                'type'=>$data['type']
            ],['id'=>$data['id']]);
            if($res){
                $this->success('修改栏目成功！','cate/index');
            }else{
                $this->error('修改失败！');
            }
        }
        //获取所有栏目
        $cates =  model('Cate')->cateTree();
        return $this->fetch('',[
            'info'=>$info,
            'cates'=>$cates
        ]);

    }
    //添加
    public function  add(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('Cate');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $res = model('Cate')->save($data);
            if($res){
                $this->success('添加栏目成功！','cate/index');
            }else{
                $this->error('添加失败！');
            }
        }else{
            //获取所有栏目
            $cates =  model('Cate')->cateTree();
            return $this->fetch('',[
                'cates'=>$cates
            ]);
        }

    }
    //删除
    public function delete($id){
        $res = model('Cate')->where('id='.$id)->delete();
        //当删除的是顶级栏目的时候 需要用到前置操作
        if($res){
            $this->success('删除成功！','cate/index');
        }else{
            $this->error('删除失败！');
        }
    }
    //删除顶级栏目的时候  也要删除下级
    public function  del_son(){
        //接收要删除的id
        $cateId = input('id');
        //获取顶级栏目下的所有子级的id
        $sonId = model('Cate')->getChildren($cateId);
        //接收所有子栏目
        $allcateid = $sonId;
        //当前栏目的id 也放到这个数组中
        $allcateid[] = $cateId;
        foreach ($allcateid as $k => $v){
            model('Article')->where('cateid='.$v)->delete();
        }
        if($sonId){//如果存在子栏目
            db('cate')->delete($sonId);
        }

    }
}
