<?php

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\Apply
 * @method array getlist(\app\admin\page\BasePage $object) static 获得列表信息
 * @method array get(array $array) static 获得信息
 * @method int create(array $array) static 新增
 * @method array export(array $array) static 新增
 * @method int update(array $array) static 修改
 * @method int delete(array $array) static 删除
 * @method bool exist(string $openid) static 是否已经申请
 */
class Apply extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\Apply';
    }
}