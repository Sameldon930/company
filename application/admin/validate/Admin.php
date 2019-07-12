<?php
namespace  app\admin\validate;

use think\Validate;

class Admin extends Validate{

    protected $rule = [
        ['name','require','管理员名称不能为空'],
        ['password','require','管理员密码不能为空']
    ];
}