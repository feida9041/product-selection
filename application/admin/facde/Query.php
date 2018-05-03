<?php

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\Query
 * @method array getlist(\app\admin\page\BasePage $object) static 获得列表信息
 * @method array getApiList() static 获得列表信息
 * @method int create(array $array) static 新增
 * @method int delete(array $array) static 删除
 * @method int deleteByOpenId(string $openid) static 删除
 */
class Query extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\Query';
    }
}