<?php

namespace app\admin\service;

use app\admin\page\BasePage;
use app\admin\service\helper\CreateHelper;
use app\admin\service\helper\DeleteHelper;
use app\admin\service\helper\ListHelper;
use app\common\model\QueryModel;
use app\common\model\UserModel;

class Query extends BaseService
{
    use ListHelper, CreateHelper, DeleteHelper;

    protected $model = QueryModel::class;

    protected function createSearch(BasePage $page)
    {
        $where = [];
        $search = $page->getSearch();
        if (isset($search['openid'])) {
            $where['openid'] = $search['openid'];
        }
        return $where;
    }

    protected function createField()
    {
        return 'data,openid';
    }

    public function getApiList($data)
    {
        $openid = $data['openid'];
        return $this->getModel()
            ->where('openid', $openid)
            ->field('data')
            ->order('id desc')
            ->limit(5)
            ->select();
    }

    public function deleteByOpenId($openid)
    {
        return $this->getModel()->where('openid', $openid)->delete();
    }

}