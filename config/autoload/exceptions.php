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

use App\Exception\Handler\TokenExceptionHandler;
use Lengbin\Hyperf\Common\Exception\Handler\AppExceptionHandler;
use Lengbin\Hyperf\Common\Exception\Handler\BusinessExceptionHandler;

return [
    'handler' => [
        'http' => [
            TokenExceptionHandler::class,
            BusinessExceptionHandler::class,
            AppExceptionHandler::class,
        ],
    ],
];
