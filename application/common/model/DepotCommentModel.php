<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:25
 */

namespace app\common\model;

use app\admin\service\Manager;
use think\facade\Session;
use think\Model;

class DepotCommentModel extends Model
{
    protected $name = 'depot_comment';
    protected $autoWriteTimestamp = true;
    protected $update = ['manager_id'];
    protected $append = ['user_info', 'manager_info', 'status_name', 'depot_name'];

    protected function setManagerIdAttr($value)
    {
        return Session::get(Manager::SESSION_USER_INFO)['id'];
    }

    protected function setCommentAttr($value)
    {
        return string_remove_xss($value);
    }

    public function getUserInfoAttr($value, $data)
    {
        if (isset($data['openid'])) {
            return UserModel::getUserInfoByOpenid($data['openid']);
        }
        return ['nick_name' => '', 'avatar' => ''];
    }

    public function getManagerInfoAttr($value, $data)
    {
        if (isset($data['manager_id']) && $data['manager_id']) {
            return ManagerModel::getManagerInfoById($data['manager_id']);
        }
        return null;
    }

    public function getDepotNameAttr($value, $data)
    {
        if (isset($data['depot_id'])) {
            return DepotModel::getDepotNameById($data['depot_id']);
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