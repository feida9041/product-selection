<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/1
 * Time: 14:48
 */

namespace app\admin\validate;

use app\admin\facde\TravelLocation;
use app\common\model\DepotModel;
use think\Validate;

class DepotValidate extends Validate
{

    protected $rule = [
        'id'           => 'require',
        'name'         => 'require|max:50',
        'square_meter' => 'require|integer',
        'address'      => 'require|max:100',
        'continent'    => 'require|checkConitnent',
        'business'     => 'array|checkBusiness',
        'pdf'          => 'array|checkSource',
        'photos'       => 'array|checkSource',
        'contacts'     => 'array|checkContacts',
    ];

    protected $message = [
    ];

    protected $scene = [
        'get'    => ['id'],
        'delete' => ['id'],
        'create' => ['name', 'square_meter', 'address', 'continent', 'business', 'pdf', 'photos', 'contacts'],
        'update' => ['name', 'square_meter', 'address', 'continent', 'business', 'pdf', 'photos', 'contacts'],
    ];

    public function checkConitnent($value)
    {
        return array_key_exists($value, TravelLocation::getContinent()) ? true : false;
    }

    public function checkBusiness($value)
    {
        $return = true;
        foreach ($value as $val) {
            if (!isset(DepotModel::businessType()[$val])) {
                $return = false;
                break;
            }
        }
        return $return;
    }


    public function checkSource($array)
    {
        $return = true;
        foreach ($array as $value) {
            if (empty($value['path']) || empty($value['uid']) || empty($value['name']) || empty($value['status']) || empty($value['size'])) {
                $return = 'PDF或轮播图片格式错误';
                break;
            }
        }
        return $return;
    }

    public function checkContacts($array)
    {
        $return = true;
        foreach ($array as $value) {
            if (empty($value['name'])) {
                $return = '联系人姓名必填';
                break;
            }
        }
        return $return;
    }


}