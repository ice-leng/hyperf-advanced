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
    'http' => [
        \Lengbin\Hyperf\Auth\Middleware\CorsMiddleware::class,
        \Lengbin\Hyperf\Auth\Middleware\ApiMiddleware::class,
        \Lengbin\Hyperf\Helper\Middleware\ServerMiddleware::class
    ],
];
