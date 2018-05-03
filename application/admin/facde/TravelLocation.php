<?php

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\TravelLocation
 * @method bool login() static 登陆
 * @method array getContinent() static 获得大洲
 */
class TravelLocation extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\TravelLocation';
    }
}