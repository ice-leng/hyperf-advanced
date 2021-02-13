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

use Hyperf\Apidog\Middleware\ApiValidationMiddleware;
use Lengbin\Hyperf\Auth\Middleware\ApiMiddleware;
use Lengbin\Hyperf\Common\Middleware\CorsMiddleware;
use Lengbin\Hyperf\YiiSoft\Rbac\Middleware\PermissionMiddleware;

return [
    'http' => [
        CorsMiddleware::class,
        ApiMiddleware::class,
        ApiValidationMiddleware::class,
        PermissionMiddleware::class
    ],
];
