<?php

namespace app\admin\facde;

use think\Facade;

/**
 * @see \app\admin\service\Message
 * @method array send(array $array) static 发消息
 */
class Message extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\admin\service\Message';
    }
}