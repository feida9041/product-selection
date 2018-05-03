<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/1
 * Time: 14:48
 */

namespace app\admin\validate;

use app\admin\validate\helper\ValidCustom;
use think\Validate;

class ApplyValidate extends Validate
{
    use ValidCustom;
    protected $rule = [
        'id'           => 'require',
        'contact'      => 'require|max:30',
        'openid'       => 'require',
        'position'     => 'max:30',
        'company_name' => 'max:60',
        'tel'          => 'require|max:20',
        'email'        => 'require|max:50|email',
        'status'       => 'require|in:0,1',
        'day'          => 'integer',
    ];

    protected $scene = [
        'get'    => ['id'],
        'create' => ['contact', 'position', 'company_name', 'tel', 'email', 'openid'],
        'update' => ['id', 'status'],
        'delete' => ['id'],
        'export' => ['day'],
    ];

}