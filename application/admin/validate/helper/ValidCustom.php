<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 18:25
 */

namespace app\admin\validate\helper;

use think\facade\Cache;

trait ValidCustom
{
    public function uploadImgExt($value)
    {
        $url = explode('.', $value);
        if (count($url) === 2 && in_array($url[1], ['gif', 'jpg', 'jpeg', 'png'])) {
            return true;
        }
        return false;
    }

    public function uploadPdfExt($value)
    {
        $url = explode('.', $value);
        if (count($url) === 2 && $url[1] == 'pdf') {
            return true;
        }
        return false;
    }

    public function checkVerify($value, $options, $data)
    {
        if (empty($data['verify_name']) || empty($data['verify_key'])) {
            return '验证码有错误';
        }
        $cache = Cache::get($data['verify_name']);
        if (empty($cache[$data['verify_key']])) {
            return '未找到验证码';
        } elseif ($value == $cache[$data['verify_key']] && $value) {
            Cache::rm($data['verify_name']);
            return true;
        } else {
            return '验证码填写错误';
        }
    }
}