<?php

namespace app\admin\middleware;

use app\admin\facde\JwtServer;
use think\facade\Session;
use think\Request;

class Auth
{
    /**
     * @param $request Request
     */
    public function handle(Request $request, \Closure $next)
    {
        $authorization = $request->header('authorization');
        if($authorization){
            JwtServer::valid($authorization);
            if (!Session::has('user_info')) {
                return json()->code('401');
            }
        }else{
            return json()->code(400);
        }
        return $next($request);
    }
}
