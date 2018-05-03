<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:48
 */

namespace app\api\controller;

use app\admin\facde\ElementUi;
use app\admin\facde\Query;
use app\admin\facde\TravelLocation;
use app\common\controller\ApiController;
use app\common\model\DepotModel;

class Depot extends ApiController
{
    public function getList()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\BaseListValidate');
        $search['openid'] = $this->openid;
        $search['data'] = $data;
        Query::create($search);
        return \app\admin\facde\Depot::getApilist(ElementUi::init($data));
    }

    public function get()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\DepotValidate.get');
        return \app\admin\facde\Depot::apiGet($data);
    }

    public function info()
    {
        return [
            'continent'     => array_values(TravelLocation::getContinent()),
            'business_type' => array_values(DepotModel::businessType()),
        ];
    }

    public function comment()
    {
        $data = $this->request->param();
        $data['openid'] = $this->openid;
        $this->validate($data, 'app\admin\validate\CommentValidate.create');
        return \app\admin\facde\Comment::create($data);
    }
}