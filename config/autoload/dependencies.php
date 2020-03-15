<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

return array_merge([
    'BackendServer' => Hyperf\HttpServer\Server::class,
], value(function () {
    $data = [];
    $rootDir = BASE_PATH . '/service';
    $paths = [$rootDir];
    $interfaceName = 'Interface';
    while (1) {
        if (empty($paths)) {
            break;
        }
        $dir = [];
        foreach ($paths as $path) {
            foreach (array_diff(scandir($path), ['.', '..']) as $item) {
                $file = $path . DIRECTORY_SEPARATOR . $item;
                if (is_dir($file)) {
                    $dir[] = $file;
                } else {
                    $fileName = basename($file, '.php');
                    if (\Lengbin\Helper\YiiSoft\StringHelper::matchWildcard('*' . $interfaceName, $fileName)) {
                        $namespace = 'Service' . substr($path, (strlen($rootDir)));
                        $namespace = str_replace('/', '\\', $namespace);
                        $data[$namespace . '\\' . $fileName] = $namespace . '\\' . str_replace($interfaceName, 'Impl', $fileName);
                    }
                }
            }
        }
        $paths = $dir;
    }
    return $data;
}));

