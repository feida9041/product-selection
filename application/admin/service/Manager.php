<?php

namespace app\admin\service;

use app\admin\page\BasePage;
use app\admin\service\helper\CreateHelper;
use app\admin\service\helper\DeleteHelper;
use app\admin\service\helper\GetHelper;
use app\admin\service\helper\ListHelper;
use app\common\exception\AdminException;
use app\common\model\ManagerModel;

class Manager extends BaseService
{
    use ListHelper, GetHelper, CreateHelper, DeleteHelper {
        CreateHelper::create AS baseCreate;
    }

    const SESSION_USER_INFO = 'user_info';

    protected $username = null;
    protected $password = null;

    protected $model = ManagerModel::class;

    protected function listField()
    {
        return 'id,username,power,logins,create_time,nick_name,avatar,is_system';
    }

    protected function createSearch(BasePage $page)
    {
        $where = [];
        $search = $page->getSearch();
        if (isset($search['power'])) {
            $where['power'] = $search['power'];
        }
        if (isset($search['nick_name'])) {
            $where[] = ['nick_name', 'like', '%' . $search['nick_name'] . '%'];
        }
        return $where;
    }

    protected function getField()
    {
        return 'id,username,power,nick_name,avatar,is_system';
    }

    protected function createField()
    {
        return 'username,nick_name,password,avatar,power';
    }

    protected function updateField()
    {
        return 'username,nick_name,password,avatar,power';
    }

    protected function deleteCondition($id, $data)
    {
        return [
            'is_system' => 0,
            'id'        => $id,
        ];
    }

    public function create($data)
    {
        $data['password'] = md5($data['password']);
        return $this->baseCreate($data);
    }

    public function update($data)
    {
        $id = (int)$data['id'];
        $model = $this->getModel()->where('id', $id)->find();
        if ($model) {
            if (isset($data['password']) && $data['password']) {
                $data['password'] = md5($data['password']);
            } else {
                unset($data['password']);
            }
            if ($model->is_system === 1) {
                $this->getModel()->allowField('username,nick_name,password,avatar')->save($data, ['id' => $id]);
            } else {
                $this->getModel()->allowField($this->updateField())->save($data, ['id' => $id]);
            }
            return $this->getModel()->id;
        } else {
            throw new AdminException(400, lang('DATA_NOT_FOUND'));
        }
    }

    public function login()
    {
        $user = ManagerModel::where([
            'username' => $this->username,
            'password' => md5($this->password),
        ])->field('id,power,logins,create_time,nick_name,avatar,logins')->find();
        if (empty($user)) {
            return false;
        }
        $user->logins += 1;
        $user->save();
        $userInfo = $user->toArray();
        $userInfo['token'] = \app\admin\facde\JwtServer::create($userInfo);
        return $userInfo;
    }

}