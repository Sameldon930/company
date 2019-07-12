<?php
namespace  app\admin\model;

use think\Model;

class  Article extends  Model{
    protected static function init(){
        //插入之前 先处理好图片上传
        Article::event('before_insert', function ($data) {
            if($_FILES['thumb']['tmp_name']){
                $file = request()->file('thumb');
                //存放位置
                $info = $file->move(ROOT_PATH.'public'.DS.'uploads');

                if($info){
                    $thumb = 'http://127.0.0.1/'.'uploads'.'/'.$info->getSaveName();
                    $data['thumb'] = $thumb;
                }
            }
        });
        //编辑的时候  修改图片 先把原先的图片删掉
        Article::event('before_update', function ($data) {
            if($_FILES['thumb']['tmp_name']){
                $file = request()->file('thumb');
                //存放位置
                $info = $file->move(ROOT_PATH.'public'.DS.'uploads');

                if($info){
                    $thumb = 'http://127.0.0.1/'.'uploads'.'/'.$info->getSaveName();
                    $data['thumb'] = $thumb;
                }
                //获取当前id 的相关数据
                $info = Article::find($data->id);
                if(file_exists($info->thumb)){//如果存在图片  就删掉
                    @unlink($info->thumb);
                }
            }
        });

        Article::event('before_delete',function($data){
            $arts = Article::find($data->id);
            $thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
            if(file_exists($thumbpath)){
                @unlink($thumbpath);
            }
        });
    }

}