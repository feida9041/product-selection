<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/31
 * Time: 14:46
 */

namespace app\admin\service;

use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
use think\facade\Session;

class JwtServer
{
    /**
     * @param array $userInfo 用户信息
     * @return string jwt token
     */
    public function create($userInfo)
    {
        $sessionConfig = config('session.');
        $jwtConfig = config('jwt.');
        $id = Uuid::uuid4()->toString();
        $sessionConfig['id'] = $id;
        Session::init($sessionConfig);
        Session::set(Manager::SESSION_USER_INFO, $userInfo);
        $jwtInfo = array(
            'iss' => $jwtConfig['iss'],
            'aud' => $jwtConfig['aud'],
            'iat' => time(),
            'session_id' => $id
        );
        return JWT::encode($jwtInfo, $jwtConfig['key']);
    }

    /**
     * @param string $token jwt token
     * @return bool
     */
    public function valid($token)
    {
        $sessionConfig = config('session.');
        $jwtInfo = JWT::decode($token, config('jwt.key'), array('HS256'));
        if (property_exists($jwtInfo, 'session_id')) {
            $sessionConfig['id'] = $jwtInfo->session_id;
            Session::init($sessionConfig);
            if (Session::has(Manager::SESSION_USER_INFO)) {
                return true;
            }
            Session::clear();
        }
        return false;
    }
}