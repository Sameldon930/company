<?php
namespace  app\admin\validate;

use think\Validate;

class Link extends Validate{

    protected $rule = [
        ['title','require','链接名称不能为空'],
        ['description','require','描述不能为空'],
        ['url','require','链接地址不能为空'],
    ];
}