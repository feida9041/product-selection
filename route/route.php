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
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET,POST,PUT,DELETE');
header('Access-Control-Allow-Headers:x-requested-with,Content-Type,Access-Token,Authorization,Accept,Token');
header('Content-type: application/json');

use \think\facade\Route;


Route::group('api/v1/admin', function () {
    Route::post('login', 'admin/Login/login');  //登录
    Route::group('', function () {
        //退出
        Route::get('logout', 'admin/Manager/logout');
        //上传
        Route::post('upload/[:type]', 'admin/Upload/upload');
        Route::delete('upload/[:path]', 'admin/Upload/delete');
        //管理员
        Route::get('manager/:id', 'admin/Manager/get');
        Route::get('manager', 'admin/Manager/getList');
        Route::post('manager', 'admin/Manager/save');
        Route::delete('manager', 'admin/Manager/delete');
        //仓库
        Route::get('depot/:id', 'admin/Depot/get');
        Route::get('depot', 'admin/Depot/getList');
        Route::post('depot', 'admin/Depot/save');
        Route::delete('depot', 'admin/Depot/delete');
        Route::delete('source', 'admin/Depot/deleteSource');
        Route::delete('contact', 'admin/Depot/deleteContact');
        //小程序用户
        Route::get('user/:id', 'admin/User/get');
        Route::get('user', 'admin/User/getList');
        Route::delete('user', 'admin/User/delete');
        //小程序用户查询
        Route::get('query/:id', 'admin/Query/index');
        Route::get('query', 'admin/Query/getList');
        Route::delete('query', 'admin/Query/delete');
        //申请加入
        //Route::get('apply/:id', 'admin/Apply/get');
        Route::get('exportapply', 'admin/Apply/export');
        Route::get('apply', 'admin/Apply/getList');
        Route::post('apply', 'admin/Apply/update');
        Route::delete('apply', 'admin/Apply/delete');
        //评论
        //Route::get('apply/:id', 'admin/Apply/get');
        Route::get('exportcomment', 'admin/Comment/export');
        Route::get('comment', 'admin/Comment/getList');
        Route::post('comment', 'admin/Comment/update');
        Route::delete('comment', 'admin/Comment/delete');
    })->middleware([\app\admin\middleware\Auth::class, \app\admin\middleware\Power::class])->allowCrossDomain(true);
    Route::miss(function () {
        return json('admin 404')->code(404);
    });
})->allowCrossDomain();

Route::group('api/v1/miniprogram', function () {
    Route::post('login', 'api/Login/login');  //登录
    Route::get('info', 'api/Depot/info');
    //仓库
    Route::get('depot/:id', 'api/Depot/get');
    Route::get('depot', 'api/Depot/getList');
    //小程序用户查询
    Route::get('query', 'api/Query/getList');
    Route::delete('query', 'api/Query/delete');
    //申请加入
    Route::post('apply', 'api/Apply/create');
    Route::get('exist', 'api/Apply/exist');
    //评论
    Route::post('comment', 'api/Depot/comment');
    //评论
    Route::post('user', 'api/User/update');
    Route::get('userexist', 'api/User/exist');
    Route::get('user', 'api/User/get');
    //发短信
    Route::post('message', 'api/Message/send');
    Route::post('checkMessage', 'api/Message/check');
    Route::any('testMessage', 'api/Message/testMessage');
    Route::miss(function () {
        return json('api 404')->code(404);
    });
})->allowCrossDomain();

Route::miss(function () {
    return json()->code(404);
});
