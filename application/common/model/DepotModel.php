<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:25
 */

namespace app\common\model;

use app\admin\facde\TravelLocation;
use app\admin\service\Manager;
use think\Db;
use think\facade\Session;
use think\Model;

class DepotModel extends Model
{
    protected $name = 'depot';
    protected $autoWriteTimestamp = true;
    protected $append = ['continent_name'];
    protected $insert = ['manager_id'];
    protected static $nameList = [];

    protected function setManagerIdAttr($value)
    {
        return Session::get(Manager::SESSION_USER_INFO)['id'];
    }

    protected function setIntroduceAttr($value)
    {
        return string_remove_xss($value);
    }

    protected function setBusinessAttr($value)
    {
        return array_sum($value);
    }

    public function source()
    {
        return $this->hasMany('depot_source');
    }

    public function contacts()
    {
        return $this->hasMany('depot_contacts');
    }

    public static function getBusinessNameByBusiness($key)
    {
        $return = '';
        foreach (self::businessType() as $k => $v) {
            if ($key & $k) {
                $return = $v['label'];
                break;
            }
        }
        return $return;
    }

    public function getBusinessAttr($value, $data)
    {
        $type = [];
        if ($value) {
            foreach (self::businessType() as $k => $v) {
                if ($value & $k) {
                    $type[] = $k;
                }
            }
        }
        return $type;
    }


    public static function getContinentNameByContinent($key)
    {
        $config = TravelLocation::getContinent();
        return $config[$key]['name'];
    }

    public function getContinentNameAttr($value, $data)
    {
        $config = TravelLocation::getContinent();
        if (isset($data['continent']) && isset($config[$data['continent']])) {
            return $config[$data['continent']]['name'];
        }
        return null;
    }

    public static function businessType()
    {
        return [
            1 => [
                'key'   => 1,
                'label' => 'B2B',
            ],
            2 => [
                'key'   => 2,
                'label' => 'B2小B',
            ],
            4 => [
                'key'   => 4,
                'label' => 'B2C',
            ],
            8 => [
                'key'   => 8,
                'label' => 'B2B2C',
            ],
        ];
    }

    public static function getDepotNameById($id)
    {
        if (!isset(static::$nameList[$id])) {
            $name = Db::name('depot')->where('id', $id)->field('name')->find();
            static::$nameList[$id] = empty($name) ? 'unknown' : $name['name'];
        }
        return static::$nameList[$id];
    }

}