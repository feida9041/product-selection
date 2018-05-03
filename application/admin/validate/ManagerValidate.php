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

class ManagerValidate extends Validate
{
    use ValidCustom;

    protected $rule = [
        'id' => 'require',
        'avatar' => 'uploadImgExt',
        'username' => 'require|min:4|max:20|unique:admin|alphaDash',
        'nick_name' => 'require|min:2|max:20',
        'password' => 'require|length:32',
        'power' => 'require|in:1,2,3,4',
    ];

    protected $message = [
        'avatar' => 'manager_avatar_error',
        'username.require' => 'manager_username_require_error',
        'username.unique' => 'manager_username_unique_error',
        'username.max' => 'manager_username_length_error',
        'username.min' => 'manager_username_length_error',
        'nick_name.require' => 'manager_nick_name_require_error',
        'nick_name.max' => 'manager_nick_name_length_error',
        'nick_name.min' => 'manager_nick_name_length_error',
        'password.require' => 'manager_password_require',
        'power' => 'manager_power_error',
    ];

    protected $scene = [
        'get' => ['id'],
        'create' => ['username', 'password', 'nick_name', 'avatar', 'power'],
        'update' => ['id', 'username', 'nick_name', 'avatar', 'power'],
        'delete' => ['id'],
    ];

}