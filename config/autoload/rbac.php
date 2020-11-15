<?php

/**
 * DbManager
 * return [
 *      'driver'       => \Lengbin\YiiSoft\Rbac\Manager\DbManager::class,
 *      'connection'   => null, // 连接db ,可以不需要
 *      'cache'        => \Cache\Cache::class, //缓存类,可以不需要
 *      'log'          => null // log key 名称
 *      'defaultRoles' => [], // 默认角色,可以不需要
 *      'item'         => null, // item 表名称,可以不需要
 *      'assignment'   => null, // assignment 表名称,可以不需要
 *      'rule'         => null, // rule 表名称,可以不需要
 *      'itemChild'    => null, // itemChild 表名称,可以不需要
 *      'menu'         => null, // menu 表名称,可以不需要
 * ];
 *
 * PhpManager
 * return [
 *      'driver'       => \Lengbin\YiiSoft\Rbac\Manager\PhpManager::class,
 *      'cache'        => \Cache\Cache::class, //缓存类,可以不需要
 *      'log'          => null // log key 名称
 *      'defaultRoles' => [], // 默认角色,可以不需要
 *      'item'         => null, // item 缓存名称,可以不需要
 *      'assignment'   => null, // assignment 缓存名称,可以不需要
 *      'rule'         => null, // rule 缓存名称,可以不需要
 *      'menu'         => null, // menu 表名称,可以不需要
 * ];
 *
 * PhpManagerFile
 * return [
 *      'driver'       => \Lengbin\YiiSoft\Rbac\Manager\PhpManagerFile::class,
 *      'directory'    => './cache', //保存文件路径,可以不需要
 *      'log'          => null // log key 名称
 *      'defaultRoles' => [], // 默认角色,可以不需要
 *      'item'         => null, // item 保存文件名称,可以不需要
 *      'assignment'   => null, // assignment 保存文件名称,可以不需要
 *      'rule'         => null ,// rule 保存文件名称,可以不需要
 *      'menu'         => null, // menu 表名称,可以不需要
 * ];
 */

use Lengbin\YiiSoft\Rbac\Manager\PhpManagerFile;

return [
    'driver'    => PhpManagerFile::class,
    'directory' => BASE_PATH . '/runtime/role',
];
