<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Lengbin\Hyperf\Common\Exception\Handler\AppExceptionHandler;
use Lengbin\Hyperf\Common\Exception\Handler\BusinessExceptionHandler;
use Lengbin\Hyperf\Exception\Handler\AuthTokenExceptionHandler;

return [
    'handler' => [
        'http' => [
            AuthTokenExceptionHandler::class,
            BusinessExceptionHandler::class,
            AppExceptionHandler::class,
        ],
    ],
];
