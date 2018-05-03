<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/31
 * Time: 14:46
 */

namespace app\admin\service;

use app\common\model\TravelLocationModel;

class TravelLocation extends BaseService
{
    protected $model = TravelLocationModel::class;

    public function getContinent()
    {
        if (cache('continent_info')) {
            return cache('continent_info');
        }
        $data = $this->getModel()->field('id,name,pid')->where('level', 1)->limit(6)->column('id,name,pid', 'id');
        cache('continent_info', $data);
        return $data;
    }
}