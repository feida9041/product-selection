<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/1
 * Time: 14:48
 */

namespace app\admin\validate;

use think\Validate;

class CommentValidate extends Validate
{
    protected $rule = [
        'id'       => 'require',
        'depot_id' => 'require',
        'comment'  => 'require|max:255',
        'openid'   => 'require',
        'status'   => 'require|in:0,1',
    ];

    protected $scene = [
        'get'    => ['id'],
        'create' => ['depot_id', 'comment', 'openid'],
        'update' => ['id', 'status'],
        'delete' => ['id'],
    ];

}