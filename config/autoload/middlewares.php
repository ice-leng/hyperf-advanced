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

use App\Kernel\Middleware\CorsMiddleware;
use App\Kernel\Middleware\DebugLogMiddleware;
use App\Middleware\TokenMiddleware;
use Hyperf\Apidog\Middleware\ApiValidationMiddleware;

return [
    'http' => [
        CorsMiddleware::class,
        DebugLogMiddleware::class,
//	    TokenMiddleware::class,
        ApiValidationMiddleware::class,
    ],
];
