<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:59
 */

namespace app\common\controller;

use app\admin\facde\User;
use app\common\exception\AdminException;
use Firebase\JWT\JWT;
use think\Controller;

abstract class ApiController extends Controller
{
    protected $batchValidate = true;
    protected $failException = true;

    protected $openid = null;

    protected $beforeActionList = [
        'auth',
    ];

    protected function auth()
    {
        $token = $this->request->header('authorization');
        if ($token) {
            $jwtInfo = JWT::decode($token, config('jwt.key'), ['HS256']);
            if (property_exists($jwtInfo, 'openid')) {
                if (!empty(User::get($jwtInfo->openid))) {
                    $this->openid = $jwtInfo->openid;
                    return true;
                }
            }
        }
        throw new AdminException(401, 'Unauthorized');
    }

}