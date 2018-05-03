<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/27
 * Time: 23:24
 */

namespace app\common\model;

use app\admin\service\Manager;
use think\facade\Session;
use think\Model;

class ApplyModel extends Model
{
    protected $name = 'apply';
    protected $autoWriteTimestamp = true;
    protected $append = ['user_info', 'manager_info', 'status_name'];
    protected $update = ['manager_id'];

    protected function setManagerIdAttr($value)
    {
        return Session::get(Manager::SESSION_USER_INFO)['id'];
    }

    public function getUserInfoAttr($value, $data)
    {
        if (isset($data['openid'])) {
            return UserModel::getUserInfoByOpenid($data['openid']);
        }
        return ['nick_name' => '无', 'avatar' => ''];
    }

    public function getManagerInfoAttr($value, $data)
    {
        if (isset($data['manager_id']) && $data['manager_id']) {
            return ManagerModel::getManagerInfoById($data['manager_id']);
        }
        return null;
    }

    public function getStatusNameAttr($value, $data)
    {
        if (isset($data['status'])) {
            $config = [
                0 => '未审核',
                1 => '已审核',
            ];
            return $config[$data['status']];
        }
        return null;
    }


}