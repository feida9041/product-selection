<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/27
 * Time: 23:24
 */

namespace app\common\model;

use think\Db;
use think\Model;

class ManagerModel extends Model
{
    protected $name = 'admin';
    protected $autoWriteTimestamp = true;
    protected $append = ['power_name'];
    protected static $managerList = [];

    public function getPowerNameAttr($value, $data)
    {
        if (isset($data['power'])) {
            $config = self::managerPower();
            return $config[$data['power']]['label'];
        }
        return null;
    }

    public static function managerPower()
    {
        return [
            1 => [
                'key'   => 1,
                'label' => lang('manager_admin'),
            ],
            2 => [
                'key'   => 2,
                'label' => lang('manager_operator'),
            ],
            3 => [
                'key'   => 3,
                'label' => lang('manager_messenger'),
            ],
            4 => [
                'key'   => 4,
                'label' => lang('manager_watcher'),
            ],
        ];
    }

    public static function getManagerInfoById($id)
    {
        if (!isset(static::$managerList[$id])) {
            static::$managerList[$id] = Db::name('admin')->where('id', $id)->field('nick_name,avatar')->find();
        }
        return static::$managerList[$id];
    }

}