<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:49
 */

namespace app\api\controller;

use app\common\controller\ApiController;
use think\facade\Cache;
use Yunpian\Sdk\YunpianClient;

class Message extends ApiController
{
    public function send()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\MessageValidate.create');
        $verify = mt_rand('100000', '999999');
        $type = $data['type'];
        $phone = $data['phone'];
        $res = \app\admin\facde\Message::send([
            'phone'  => $phone,
            'verify' => $verify,
            'id'     => $this->openid,
        ]);
//        $result = json_decode($res, true);
//        if ($result['type'] == 'message.data') {
        if ($res['status'] == 'success') {
            $verifyKey = 'verify_' . $this->openid;
            Cache::rm($verifyKey);
            Cache::set($verifyKey, [$type => $verify], 90);
            return json('ok');
        } else {
            return json('短信发送失败')->code(400);
        }

    }

    public function check()
    {
        $data = $this->request->param();
        $data['verify_key'] = $data['type'];
        $data['verify_name'] = 'verify_' . $this->openid;
        $this->validate($data, 'app\admin\validate\MessageValidate.check');
        return true;
    }

    public function testMessage()
    {
    }
}