<?php
namespace  app\admin\validate;

use think\Validate;

class Cate extends Validate{

    protected $rule = [
        ['catename','require','栏目名称不能为空']
    ];
}