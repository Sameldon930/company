<?php
namespace app\admin\controller;
use app\admin\model\AuthRule as AuthRuleModel;
use think\Controller;

class AuthRule extends Base {


    public function index(){
        $auth_rules = model('AuthRule')->ruleTree();
        return $this->fetch('auth_rule/lists',[
            'auth_rules'=>$auth_rules
        ]);
    }
    public function  add(){
        if(request()->isPost()){
            $data = input('post.');
            //获取顶级栏目的等级 后续要进行加1处理 存到对应的子级中
            $plevel = db('auth_rule')->where('id='.$data['pid'])->field('level')->find();
            if($plevel){
                $data['level'] = $plevel['level'] + 1;//子级栏目的等级加1
            }else{//如果添加的权限是属于顶级的 那么level就是0 不加1
                $data['level'] = 0;
            }

            $res = db('auth_rule')->insert($data);
            if($res){
                $this->success('添加成功！','auth_rule/index');
            }else{
                $this->error('添加失败！');
            }
        }
        $rules = model('AuthRule')->ruleTree();//递归排序获取所有权限
        return $this->fetch('',[
            'rules'=>$rules
        ]);
    }

    public function edit($id){
        $info = model('AuthRule')->where('id='.$id)->find();
        if(request()->isPost()){
            $data = input('post.');
            //获取顶级栏目的等级 后续要进行加1处理 存到对应的子级中
            $plevel = db('auth_rule')->where('id='.$data['pid'])->field('level')->find();
            if($plevel){
                $data['level'] = $plevel['level'] + 1;//子级栏目的等级加1
            }else{//如果添加的权限是属于顶级的 那么level就是0 不加1
                $data['level'] = 0;
            }
            $res = model('auth_rule')->save($data,['id'=>$data['id']]);
            if($res){
                $this->success('编辑成功！','auth_rule/index');
            }else{
                $this->error('编辑失败！');
            }
        }
        $rules = model('AuthRule')->ruleTree();//递归排序获取所有权限
        return $this->fetch('',[
            'info'=>$info,
            'rules'=>$rules
        ]);
    }

    public function delete(){
        $authRule = new AuthRuleModel();
        $authRuleIds = $authRule->getChildren(input('id'));
        $authRuleIds[] = input('id');

        $del= db('auth_rule')->delete($authRuleIds);
        if($del){
            $this->success('删除权限成功！',url('auth_rule/index'));
        }else{
            $this->error('删除权限失败！');
        }
    }



}
