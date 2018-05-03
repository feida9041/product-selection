<?php

namespace app\admin\behavior;

use app\admin\service\Manager;
use app\common\exception\AdminException;
use think\facade\Session;
use think\Request;

/**
 * 后台验证权限
 * @package app\admin\behavior
 */
class Power
{
    private $controller = null;
    private $action = null;

    public function run(Request $request, $params)
    {
        $this->action = $request->action();
        $this->controller = $request->controller();
        if (strtolower($this->controller) == 'login' && strtolower($this->action == 'login')) {
            return true;
        }
        if (!$this->check($this->getPower())) {
            throw new AdminException(403, '您没有权限');
        }
    }

    /**
     * @return int Level
     */
    private function getPower()
    {
        return (int)Session::get(Manager::SESSION_USER_INFO)['power'];
    }

    /**
     * @param $power
     * @return bool
     */
    private function check($power)
    {
        if ($power !== 1) {
            $code = $this->getAllowableLevel();
            if (!empty($code) && !in_array($power, $code)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    private function getAllowableLevel()
    {
        $return = [];
        $class = 'app\\admin\\controller\\' . $this->controller;
        $rc = new \ReflectionClass($class);
        $comment = $rc->getMethod($this->action)->getDocComment();
        if ($comment) {
            $str = $this->getCommentBetween($comment, '@powerlevel', '@powerlevel');
            if (strlen($str) > 0) {
                $return = explode(',', trim($str));
            }
        }
        return $return;
    }

    private function getCommentBetween($comment, $str1, $str2)
    {
        $num1 = strpos($comment, $str1);
        $num2 = strrpos($comment, $str2);
        $len1 = strlen($str1);
        $len2 = strlen($str2);
        if ($num1 == false || $num2 == false || $num2 <= ($num1 + $len2)) {
            return false;
        }
        return substr($comment, $num1 + $len1, $num2 - ($num1 + $len2));
    }
}