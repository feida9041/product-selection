<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/27
 * Time: 23:24
 */

namespace app\common\model;

use think\Model;

class QueryModel extends Model
{
    protected $name = 'query';
    protected $autoWriteTimestamp = true;
    protected $append = ['condition', 'user_info'];
    protected $json = ['data'];

    public function getConditionAttr($value, $data)
    {
        $return = [];
        if (!empty($data['data'])) {
            $search = $data['data'];
            if (property_exists($search, 'search')) {
                if (property_exists($search->search, 'continent') && $search->search->continent) {
                    $return[] = DepotModel::getContinentNameByContinent($search->search->continent);
                }
                if (property_exists($search->search, 'business') && $search->search->business) {
                    $return[] = DepotModel::getBusinessNameByBusiness($search->search->business);
                }
            }
        }
        return $return;
    }

    public function getUserInfoAttr($value, $data)
    {
        if (isset($data['openid'])) {
            return UserModel::getUserInfoByOpenid($data['openid']);
        }
        return ['nick_name' => '无', 'avatar' => ''];
    }
}