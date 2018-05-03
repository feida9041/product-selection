<?php
namespace app\admin\service;

use think\facade\Cache;

class Menu
{
    protected function config()
    {
        return [
            'head'    => [
                'main'     => '/admin/index',
                'logout'   => '/admin/logout',
                'system'   => '/admin/system',
                'editself' => '/admin/manager',
            ],
            'sidebar' => [
                [
                    'name'  => lang('left_depot'),
                    'sign'  => 'depot',
                    'icon'  => 'icon-leaf',
                    'child' => [
                        [
                            'name' => lang('left_depot_list'),
                            'sign' => 'index',
                            'url'  => '/admin/depot/index',
                        ],
                        [
                            'name' => lang('left_depot_add'),
                            'sign' => 'info',
                            'url'  => '/admin/depot',
                        ],
                    ],
                ],
                [
                    'name'  => lang('left_user_title'),
                    'sign'  => 'user',
                    'icon'  => 'icon-credit-card',
                    'child' => [
                        [
                            'name' => lang('left_user_list'),
                            'sign' => 'index',
                            'url'  => '/admin/user/index',
                        ],
                    ],
                ],
                [
                    'name'  => lang('left_log_title'),
                    'sign'  => 'user',
                    'icon'  => 'icon-zoom-in',
                    'child' => [
                        [
                            'name' => lang('left_log_list'),
                            'sign' => 'index',
                            'url'  => '/admin/query/index',
                        ],
                    ],
                ],
                [
                    'name'  => lang('left_admin_title'),
                    'sign'  => 'admin',
                    'icon'  => 'icon-group',
                    'child' => [
                        [
                            'name' => lang('left_admin_list'),
                            'sign' => 'index',
                            'url'  => '/admin/manager/index',
                        ],
                        [
                            'name' => lang('left_admin_add'),
                            'sign' => 'info',
                            'url'  => '/admin/manager',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function get($name = 'head')
    {
        if (isset($this->config()[$name])) {
            return $this->config()[$name];
        }
        return null;
    }
}