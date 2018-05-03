<?php

namespace app\admin\service;

use app\admin\facde\User;
use app\admin\page\BasePage;
use app\admin\service\helper\CreateHelper;
use app\admin\service\helper\DeleteHelper;
use app\admin\service\helper\GetHelper;
use app\admin\service\helper\ListHelper;
use app\admin\service\helper\UpdateHelper;
use app\common\exception\AdminException;
use app\common\model\ApplyModel;

class Apply extends BaseService
{
    use ListHelper, GetHelper, CreateHelper, DeleteHelper, UpdateHelper {
        CreateHelper::create AS baseCreate;
    }

    protected $model = ApplyModel::class;

    protected function createSearch(BasePage $page)
    {
        $where = [];
        $search = $page->getSearch();
        if (isset($search['status'])) {
            $where['status'] = $search['status'];
        }
        if (isset($search['search'])) {
            $where[] = ['contact|company_name', 'like', '%' . $search['search'] . '%'];
        }
        return $where;
    }

    protected function createField()
    {
        return 'openid,company_name,contact,position,tel,email';
    }

    protected function updateField()
    {
        return 'status';
    }

    public function create($data)
    {
        if (!$this->exist($data['openid'])) {
            $this->baseCreate($data);
            $data['agree'] = 1;
            User::update($data);
        } else {
            throw new AdminException(400, '您已经申请加入过,请等待审核和联系');
        }
    }

    public function exist($openid)
    {
        $id = $this->getModel()->where('openid', $openid)->field('id')->count();
        return $id > 0 ? true : false;
    }

    public function export($data)
    {
        $where = [];
        if (!empty($data['day'])) {
            $time = strtotime(date('Y-m-d', time() - ($data['day'] * 86400)));
            $where[] = ['create_time', 'gt', $time];
        }
        $data = $this
            ->getModel()
            ->field('id,openid,company_name,contact,tel,email,position,create_time,status')
            ->where($where)
            ->select();
        $list = [
            [
                mb_convert_encoding('微信昵称', 'GBK', 'UTF-8'),
                mb_convert_encoding('公司名称', 'GBK', 'UTF-8'),
                mb_convert_encoding('联系人', 'GBK', 'UTF-8'),
                mb_convert_encoding('电话', 'GBK', 'UTF-8'),
                mb_convert_encoding('邮箱', 'GBK', 'UTF-8'),
                mb_convert_encoding('职务', 'GBK', 'UTF-8'),
                mb_convert_encoding('申请时间', 'GBK', 'UTF-8'),
                mb_convert_encoding('是否审核', 'GBK', 'UTF-8'),
            ],
        ];
        foreach ($data as $v) {
            $list[] = [
                mb_convert_encoding($v['user_info']['nick_name'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['company_name'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['contact'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['tel'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['email'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['position'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['create_time'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['status_name'], 'GBK', 'UTF-8'),
            ];
        }
        return $list;
    }

}