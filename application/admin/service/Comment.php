<?php

namespace app\admin\service;

use app\admin\page\BasePage;
use app\admin\service\helper\CreateHelper;
use app\admin\service\helper\DeleteHelper;
use app\admin\service\helper\GetHelper;
use app\admin\service\helper\ListHelper;
use app\admin\service\helper\UpdateHelper;
use app\common\model\DepotCommentModel;

class Comment extends BaseService
{
    use ListHelper, GetHelper, CreateHelper, DeleteHelper, UpdateHelper;

    protected $model = DepotCommentModel::class;

    protected function createSearch(BasePage $page)
    {
        $where = [];
        $search = $page->getSearch();
        if (isset($search['status'])) {
            $where['status'] = $search['status'];
        }
        if (isset($search['comment'])) {
            $where[] = ['comment', 'like', '%' . $search['comment'] . '%'];
        }
        return $where;
    }

    protected function createField()
    {
        return 'openid,comment,depot_id';
    }

    protected function updateField()
    {
        return 'status';
    }

    public function export($arr)
    {
        $data = $this->getModel()->field('status,openid,depot_id,create_time,comment')->select();
        $list = [
            [
                mb_convert_encoding('微信昵称', 'GBK', 'UTF-8'),
                mb_convert_encoding('仓库名称', 'GBK', 'UTF-8'),
                mb_convert_encoding('评论内容', 'GBK', 'UTF-8'),
                mb_convert_encoding('评论时间', 'GBK', 'UTF-8'),
                mb_convert_encoding('是否审核', 'GBK', 'UTF-8'),
            ],
        ];
        foreach ($data as $v) {
            $list[] = [
                mb_convert_encoding($v['user_info']['nick_name'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['depot_name'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['comment'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['create_time'], 'GBK', 'UTF-8'),
                mb_convert_encoding($v['status_name'], 'GBK', 'UTF-8'),
            ];
        }
        return $list;
    }

}