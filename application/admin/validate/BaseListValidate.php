<?php

namespace app\admin\validate;

use think\Validate;

class BaseListValidate extends Validate
{
    protected $rule = [
        'page'     => 'gt:0',
        'pageSize' => 'integer',
        'order'    => 'alphaDash',
        'sort'     => 'in:ascending,descending',
        'search'   => 'array',
    ];

    protected $message = [
        'page'     => 'list_page_error',
        'pageSize' => 'list_pagesize_error',
        //'order'    => 'list_order_error',
        'sort'     => 'list_sort_error',
        'search'   => 'list_search_error',
    ];

}