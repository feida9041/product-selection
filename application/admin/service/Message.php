<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/31
 * Time: 14:46
 */

namespace app\admin\service;

use app\common\exception\AdminException;
use Curl\Curl;

require_once ROOT_PATH . '/vendor/yunpian/main.php';

class Message
{

    public function send($data)
    {
        if (!$this->check($data['id'])) {
            throw new AdminException(400, '每人每天只能发送10条短信');
        }

        return \YunPian::singelSend('dc1ac76a8cf86c488eee62e466162abd', $data['phone'], 2264104, [
            'code' => $data['verify'],
            'time' => 30,
        ]);

//        $curl = new Curl();
//        $url = 'https://app.tradecubic.com/api/v2/v1/message/create';
//
//        $msg = [
//            'msg_type'        => 'tjsh_mobile_identify',
//            'msg_target'      => $data['phone'],
//            'msg_target_type' => 'mobile',
//            'msg_category'    => 'personal',
//            'msg_title'       => '手机认证',
//            'msg_appId'       => 'f5eb12b32df9f4cf631a6d7f33550bbf',
//            'msg_meta'        => [
//                'code' => $data['verify'],
//                'time' => 30,
//            ],
//            'company_mark'    => '',
//            'msg_content'     => '',
//        ];
//        $curl->setHeader('Content-Type', 'application/json');
//        $res = $curl->post($url, json_encode($msg));
//        return $res->response;
    }

    public function check($id)
    {
        return true;
    }

}