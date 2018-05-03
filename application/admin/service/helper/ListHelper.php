<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/2
 * Time: 22:43
 */

namespace app\admin\service\helper;

use app\admin\page\BasePage;

trait ListHelper
{
    protected function listField()
    {
        return '*';
    }

    protected function listDefaultOrder()
    {
        return 'id desc';
    }

    protected function createSearch(BasePage $page)
    {
        $where = [];
        return $where;
    }

    public function getlist(BasePage $page)
    {
        $where = $this->createSearch($page);
        $list = $this->getModel()
            ->field($this->listField())
            ->where($where)
            ->order($page->getOrder() !== null ?: $this->listDefaultOrder())
            ->paginate($page->getPageSize(), false, [
                'page' => $page->getPage(),
            ])->toArray();
        return $list;
    }
}