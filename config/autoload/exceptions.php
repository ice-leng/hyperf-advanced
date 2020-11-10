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

use App\Exception\Handler\ApiDogExceptionHandler;
use Lengbin\Hyperf\Common\Exception\Handler\AppExceptionHandler;
use Lengbin\Hyperf\Common\Exception\Handler\BusinessExceptionHandler;
use Lengbin\Hyperf\Auth\Exception\Handler\AuthTokenExceptionHandler;

return [
    'handler' => [
        'http' => [
            AuthTokenExceptionHandler::class,
            ApiDogExceptionHandler::class,
            BusinessExceptionHandler::class,
            AppExceptionHandler::class,
        ],
    ],
];
