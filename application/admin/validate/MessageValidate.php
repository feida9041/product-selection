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

class MessageValidate extends Validate
{
    use ValidCustom;
    protected $rule = [
        'type'   => 'require|in:user,apply',
        'phone'  => 'require|mobile',
        'verify' => 'require|checkVerify',
    ];

    protected $scene = [
        'create' => ['type', 'phone'],
        'check' => ['type', 'verify'],
    ];


}