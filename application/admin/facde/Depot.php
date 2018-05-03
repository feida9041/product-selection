<?php

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\Depot
 * @method array getlist(\app\admin\page\BasePage $object) static 获得列表信息
 * @method array getApilist(\app\admin\page\BasePage $object) static 获得列表信息
 * @method array get(array $array) static 获得信息
 * @method array apiGet(array $array) static 获得信息
 * @method int create(array $array) static 新增
 * @method int update(array $array) static 修改
 * @method int delete(array $array) static 删除
 * @method int deleteSource(int $uid) static 删除资源
 * @method int deleteContact(int $id) static 删除联系人
 */
class Depot extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\Depot';
    }
}