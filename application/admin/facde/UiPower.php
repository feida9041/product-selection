<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/6
 * Time: 1:50
 */

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\UiPower
 * @method array get(int $powerCode) static 获得UI权限
 */
class UiPower extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\UiPower';
    }
}