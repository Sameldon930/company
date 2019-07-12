<?php
namespace  app\admin\validate;

use think\Validate;

class Article extends Validate{

    protected $rule = [
        ['title','require','文章标题不能为空'],
        ['author','require','文章作者不能为空'],
        ['keywords','require','关键词不能为空'],
        ['description','require','描述不能为空'],
        ['content','require','内容不能为空']

    ];
}