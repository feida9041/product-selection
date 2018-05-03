<?php

namespace app\admin\middleware;

use think\Request;

class Power
{
    /**
     * @param $request Request
     */
    public function handle(Request $request, \Closure $next)
    {
        return $next($request);
    }
}
