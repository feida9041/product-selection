<?php
namespace app\common\exception;

use think\exception\HttpException;

class AdminException extends HttpException
{
    public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = [], $code = 0)
    {
        if (is_string($message)) {
            $message = ['msg' => $message];
        }
        parent::__construct($statusCode, json_encode($message), $previous, $headers, $code);
    }
}
