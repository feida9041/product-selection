<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/6
 * Time: 1:45
 */

namespace app\admin\service;

class UiPower
{
    protected function config()
    {
        return [
            1         => [
                'router'  => [
                    'index.index',
                    'depot.list',
                    'depot.add',
                    'depot.edit',
                    'user.comment',
                    'user.list',
                    'user.querylist',
                    'apply.list',
                    'manager.list',
                    'manager.add',
                    'manager.edit',
                ],
                'sidebar' => [
                    'index',
                    'depot.list,add',
                    'user.list,querylist,comment',
                    'apply.list',
                    'manager.list,add',
                ],
            ],
            2         => [
                'router'  => [
                    'index.index',
                    'depot.list',
                    'depot.add',
                    'depot.edit',
                    'user.comment',
                    'user.list',
                    'user.querylist',
                    'apply.list',
                ],
                'sidebar' => [
                    'index',
                    'depot.list,add',
                    'user.list,querylist,comment',
                    'apply.list',
                ],
            ],
            3         => [
                'router'  => [
                    'index.index',
                    'depot.list',
                    'depot.add',
                    'depot.edit',
                    'user.comment',
                    'user.list',
                    'user.querylist',
                    'apply.list',
                ],
                'sidebar' => [
                    'index',
                    'depot.list,add',
                    'user.list,querylist,comment',
                    'apply.list',
                ],
            ],
            4         => [
                'router'  => [
                    'index.index',
                    'depot.list',
                    'user.comment',
                    'user.list',
                    'user.querylist',
                    'apply.list',
                ],
                'sidebar' => [
                    'index',
                    'depot.list',
                    'user.list,querylist,comment',
                    'apply.list',
                ],
            ],
            'default' => [
                'router'  => ['index.index'],
                'sidebar' => ['index'],
            ],
        ];
    }

    public function get($powerCode = 0)
    {
        $config = $this->config();
        if (isset($config[$powerCode])) {
            return $config[$powerCode];
        }
        return $config['default'];
    }
}