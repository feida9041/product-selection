<?php

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\page\ElementUi
 * @method object init(array $data = []) static 设置分页信息
 * @method int getPage() static 获得页码
 * @method int getPageSize() static 获得分页长度
 * @method string getOrder() static 获得排序
 * @method array getSearch() static 获得搜索条件
 */
class ElementUi extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\page\ElementUi';
    }
}