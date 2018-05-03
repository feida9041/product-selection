<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 23:07
 */

namespace app\admin\service;

use app\admin\page\BasePage;
use app\admin\service\helper\DeleteHelper;
use app\admin\service\helper\ListHelper;
use app\common\exception\AdminException;
use app\common\model\UserModel;
use Firebase\JWT\JWT;

class User extends BaseService
{
    use ListHelper, DeleteHelper;

    protected $model = UserModel::class;

    protected function createSearch(BasePage $page)
    {
        $where = [];
        $search = $page->getSearch();
        if (isset($search['gender'])) {
            $where['gender'] = $search['gender'];
        }
        if (isset($search['agree'])) {
            $where['agree'] = $search['agree'];
        }
        if (isset($search['nick_name'])) {
            $where[] = ['nick_name', 'like', '%' . $search['nick_name'] . '%'];
        }
        return $where;
    }

    public function login($data)
    {
        $openid = $data['openid'];
        $res = $this->get($openid);
        if (empty($res)) {
            $this->getModel()->allowField('openid,nick_name,gender,city,country,province,avatar')->save($data);//新增
        } else {
            $this->getModel()->allowField('nick_name,gender,city,country,province,avatar')->save($data, ['id' => $res['id']]);//修改
        }
        $jwtConfig = config('jwt.');
        $jwtInfo = [
            'iss'    => $jwtConfig['iss'],
            'aud'    => $jwtConfig['aud'],
            'iat'    => time(),
            'openid' => $openid,
        ];
        return JWT::encode($jwtInfo, $jwtConfig['key']);
    }

    public function get($openid)
    {
        return $this->getModel()
            ->field('id,tel,company_name')
            ->where(['openid' => $openid])
            ->find();
    }

    public function update($data)
    {
        $id = $data['openid'];;
        $model = $this->getModel()->where('openid', $id)->find();
        if ($model) {
            $this->getModel()->allowField('tel,company_name,agree')->save($data, ['openid' => $id]);
            return true;
        } else {
            throw new AdminException(400, lang('DATA_NOT_FOUND'));
        }
    }

    public function exist($openid)
    {
        $data = $this->get($openid);
        return empty($data['tel']) ? false : true;
    }
}