<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 19:39
 */

namespace app\admin\service\helper;

trait CreateHelper
{
    protected function createField()
    {
        return '*';
    }

    public function create($data)
    {
        $this->getModel()->allowField($this->createField())->save($data);
        return $this->getModel()->id;
    }
}