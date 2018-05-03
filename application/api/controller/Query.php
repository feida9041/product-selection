<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/10
 * Time: 15:02
 */

namespace app\api\controller;

use app\common\controller\ApiController;

class Query extends ApiController
{
    public function getList()
    {
        return \app\admin\facde\Query::getApiList(['openid' => $this->openid]);
    }

    public function delete()
    {
        return \app\admin\facde\Query::deleteByOpenId($this->openid);
    }
}