<?php
namespace app\common\exception;

use Exception;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\ValidateException;

class AdminApiHttp extends Handle
{
    public function render(Exception $e)
    {
        // 参数验证错误
        if ($e instanceof ValidateException) {
            return json($e->getError(), 422);
        }

        // 请求异常
        if ($e instanceof AdminException) {
            return json(json_decode($e->getMessage(), true), $e->getStatusCode());
        }

        // 其他错误交给系统处理
        return parent::render($e);
    }

}