<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 会话设置
// +----------------------------------------------------------------------

return [
    'id'             => '',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // SESSION 前缀
    'prefix'         => 'jwt_',
    // 驱动方式 支持redis memcache memcached
    'type'           => 'redis',
    // redis地址
    'host'           => \think\facade\Env::get('redis.hostname', 'localhost'),
    'password'       => \think\facade\Env::get('redis.password', ''),
    'select'         => \think\facade\Env::get('redis.select', 0),
    // redis端口
    'port'           => \think\facade\Env::get('redis.port', 6379),
    // 是否自动开启 SESSION
    'auto_start'     => true,

//    'host'         => '127.0.0.1', // redis主机
//    'port'         => 6379, // redis端口
//    'password'     => '', // 密码
//    'select'       => 0, // 操作库
//    'expire'       => 3600, // 有效期(秒)
//    'timeout'      => 0, // 超时时间(秒)
//    'persistent'   => true, // 是否长连接
//    'session_name' => '', // sessionkey前缀
];