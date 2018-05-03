<?php

namespace app\admin\controller;

use app\admin\facde\Manager;
use app\admin\facde\TravelLocation;
use app\admin\facde\UiPower;
use app\common\model\DepotModel;
use app\common\model\ManagerModel;
use think\Controller;

class Login extends Controller
{
    protected $batchValidate = true;
    protected $failException = true;

    public function login()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\LoginValidate');
        Manager::set($data);
        $userInfo = Manager::login();
        if (!$userInfo) {
            return json(['msg' => lang('index_login_error')])->code(400);
        }
        $ui = UiPower::get($userInfo['power']);
        $loginInfo = [
            'manager'       => $userInfo,
            'manager_power' => ManagerModel::managerPower(),
            'continent'     => TravelLocation::getContinent(),
            'business_type' => DepotModel::businessType(),
            'router'        => $ui['router'],
            'sidebar'       => $ui['sidebar'],
        ];
        return json($loginInfo);
    }
}
