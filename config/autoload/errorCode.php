<?php

return [
    // 错误码文件 目录
    'path'           => [
        BASE_PATH . '/vendor/lengbin/hyperf-common/src/Error',
        BASE_PATH . '/app/Constant/Errors'
    ],
    // 合并生成 类 文件名称
    'classname'      => 'Error',
    // 合并生成 类 命名空间
    'classNamespace' => 'App\\Constant',
    // 合并生成 类 文件输出目录
    'output'         => BASE_PATH . '/app/Constant',
];
