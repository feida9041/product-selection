<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/10
 * Time: 15:02
 */

namespace app\api\controller;

use app\common\controller\ApiController;

class Apply extends ApiController
{
    public function create()
    {
        $data = $this->request->param();
        $data['openid'] = $this->openid;
        $this->validate($data, 'app\admin\validate\ApplyValidate.create');
        return ['id' => \app\admin\facde\Apply::create($data)];
    }

    public function exist()
    {
        return \app\admin\facde\Apply::exist($this->openid);
    }
}