<?php
namespace  app\admin\validate;

use think\Validate;

class Conf extends Validate{

    protected $rule = [
        ['cnname','require','配置中文名称不能为空'],
        ['enname','require','配置英文名称不能为空'],
        ['type','require','配置类型不能为空'],
    ];
}