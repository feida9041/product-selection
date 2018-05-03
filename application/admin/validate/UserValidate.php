<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 23:25
 */

namespace app\admin\validate;

use app\admin\validate\helper\ValidCustom;
use think\Validate;

class UserValidate extends Validate
{
    use ValidCustom;
    protected $rule = [
        'id'           => 'require',
        'jsCode'       => 'require',
        'nick_name'    => 'require',
        'gender'       => 'integer',
        'tel'          => 'require|max:20|mobile',
        'company_name' => 'require|max:20',
        'agree'        => 'require|boolean',
    ];

    protected $scene = [
        'login'  => ['jsCode', 'nick_name', 'gender'],
        'get'    => ['id'],
        'delete' => ['id'],
        'update' => ['openid', 'tel', 'company_name', 'agree'],
    ];
}