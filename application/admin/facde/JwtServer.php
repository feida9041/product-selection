<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/31
 * Time: 14:51
 */

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\JwtServer
 * @method string create(array $userInfo) static JWT生成
 * @method bool valid(string $token) static JWT验证
 */
class JwtServer extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\JwtServer';
    }
}