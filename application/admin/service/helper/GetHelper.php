<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 13:48
 */

namespace app\admin\service\helper;

trait GetHelper
{

    protected function getField()
    {
        return '*';
    }

    protected function getCondition($data)
    {
        return ['id' => $data['id']];
    }

    public function get($data)
    {
        $data = $this->getModel()
            ->field($this->getField())
            ->where($this->getCondition($data))
            ->find();
        return $data ?: [];
    }
}