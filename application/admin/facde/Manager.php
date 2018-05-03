<?php

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\Manager
 * @method bool login() static 登陆
 * @method array getlist(\app\admin\page\BasePage $object) static 获得列表信息
 * @method array get(array $array) static 获得信息
 * @method int create(array $array) static 新增
 * @method int update(array $array) static 修改
 * @method int delete(array $array) static 删除
 */
class Manager extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\Manager';
    }
}