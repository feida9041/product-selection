<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 23:25
 */

namespace app\admin\validate;

use think\Validate;

class QueryValidate extends Validate
{
    protected $rule = [
        'id'   => 'require',
    ];

    protected $scene = [
        'get'    => ['id'],
        'delete' => ['id'],
    ];
}