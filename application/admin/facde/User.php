<?php

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\User
 * @method string login($data) static 登陆
 * @method array getlist(\app\admin\page\BasePage $object) static 获得列表信息
 * @method array userSearch(\app\admin\page\BasePage $object) static 获得搜索用户信息
 * @method array get(string $openid) static 获得信息
 * @method array update(array $data) static 获得信息
 * @method bool exist(string $openid) static 是否存在
 * @method int delete(array $array) static 删除
 */
class User extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\User';
    }
}