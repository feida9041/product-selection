<?php
return [
    'exception_tmpl'   => ROOT_PATH . DIRECTORY_SEPARATOR . '/application/common/exception/admin.tpl',
    'exception_handle' => '\\app\\common\\exception\\AdminApiHttp',
    'route_rule_merge' => true,
];
