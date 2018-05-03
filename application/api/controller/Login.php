<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:58
 */

namespace app\api\controller;

use app\admin\facde\User;
use Curl\Curl;
use think\Controller;

class Login extends Controller
{
    protected $batchValidate = true;
    protected $failException = true;

    public function login()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\UserValidate.login');
        $curl = new Curl();
        $curl_data = [
            'grant_type' => 'authorization_code',
            'js_code' => $data['jsCode'],
            'appid' => config('miniprogram.appid'),
            'secret' => config('miniprogram.secret'),
        ];
        unset($data['jsCode']);
        $curl->get(config('miniprogram.wx_session_url'), $curl_data);
        $res = json_decode($curl->response, true);
        $openid = $res['openid'];
        if ($openid) {
            $data['openid'] = $openid;
            return ['token' => User::login($data)];
        } else {
            json('openid获取失败')->code(400);
        }
    }
}