<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/10
 * Time: 15:02
 */

namespace app\api\controller;

use app\common\controller\ApiController;

class User extends ApiController
{
    public function update()
    {
        $data = $this->request->param();
        $data['openid'] = $this->openid;
        $this->validate($data, 'app\admin\validate\UserValidate.update');
        return \app\admin\facde\User::update($data);
    }

    public function get()
    {
        return \app\admin\facde\User::get($this->openid);
    }

    public function exist(){
        return \app\admin\facde\User::exist($this->openid);
    }
}