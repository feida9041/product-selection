<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:25
 */

namespace app\common\model;

use think\Db;
use think\Model;

class UserModel extends Model
{
    protected $name = 'user';
    protected $autoWriteTimestamp = true;
    protected $append = ['gender_type'];
    protected static $userInfo = [];

    public function getGenderTypeAttr($value, $data)
    {
        if (isset($data['gender'])) {
            $gender = [
                0 => '未知',
                1 => '男',
                2 => '女',
            ];
            return $gender[$data['gender']];
        }
        return null;
    }

    public function getAgreeAttr($value, $data)
    {
        if (isset($data['agree'])) {
            $config = [
                0 => '不同意',
                1 => '同意',
            ];
            return $config[$value];
        }
        return null;
    }

    public static function getUserInfoByOpenid($openid)
    {
        if (!isset(static::$userInfo[$openid])) {
            $data = Db::name('user')->where('openid', $openid)->field('nick_name,avatar')->find();
            if (empty($data)) {
                $data = ['nick_name' => '无', 'avatar' => ''];
            }
            static::$userInfo[$openid] = $data;
        }
        return static::$userInfo[$openid];
    }
}