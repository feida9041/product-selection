<?php

namespace app\admin\validate;

use think\Validate;

class LoginValidate extends Validate
{
    protected $rule = [
        'username' => 'require|min:4|max:20|alphaDash',
        'password' => 'require|length:32',
    ];

    protected $message = [
        'username.require' => 'login_username_require',
        'username.max'     => 'index_login_error',
        'username.min'     => 'index_login_error',
        'password.require' => 'login_password_require',
        'password.max'     => 'index_login_error',
        'password.min'     => 'index_login_error',
    ];

}