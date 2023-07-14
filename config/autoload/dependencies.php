<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Hyperf\Utils\Filesystem\Filesystem;

// todo 后期优化， 监听boostrap 事件，将数组写入文件，或者 直接 di 进去
$daoInterface = value(function () {
    $path = BASE_PATH . '/app/Dao/Contracts';
    $filesystem = new Filesystem();
    $scans = $filesystem->allFiles($path);
    if (!$scans) {
        return [];
    }
    $data = [];
    foreach ($scans as $scan) {
        $file = substr($scan->getRealPath(), 0, -4);
        $interface = implode('\\', array_map(function ($str) {
            return ucfirst($str);
        }, explode('/', str_replace(BASE_PATH, '', $file))));
        $interface = substr($interface, 1);
        $impl = str_replace('Contracts', 'MySQL', $interface);
        $impl = str_replace('Interface', '', $impl);
        if (interface_exists($interface) && class_exists($impl)) {
            $data[$interface] = $impl;
        }
    }
    return $data;
});

return array_merge($daoInterface, [
    Hyperf\Database\Commands\ModelCommand::class => Lengbin\Hyperf\Common\Commands\Model\ModelCommand::class,
]);
