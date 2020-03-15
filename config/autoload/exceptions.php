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

return [
    'handler' => [
        'http'    => [
            \Lengbin\Hyperf\Helper\Exception\Handler\InvalidTokenExceptionHandler::class,
            \Lengbin\Hyperf\Helper\Exception\Handler\BusinessExceptionHandler::class,
            App\Exception\Handler\AppExceptionHandler::class,
        ],
        'backend' => [
            \Backend\Exception\Handler\BackendExceptionHandler::class,
        ],
    ],
];
