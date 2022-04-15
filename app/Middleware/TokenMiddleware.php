<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  10:46 下午
 */

declare(strict_types=1);

namespace App\Middleware;

use Lengbin\Hyperf\Auth\JwtSubject;
use Lengbin\Hyperf\Auth\Middleware\BaseAuthMiddleware;
use Psr\Http\Message\ServerRequestInterface;

class TokenMiddleware extends BaseAuthMiddleware
{
    protected function getTestPayload(ServerRequestInterface $request): JwtSubject
    {
        // TODO: Implement getTestPayload() method.
    }

    protected function handlePayload(ServerRequestInterface $request, JwtSubject $payload): ServerRequestInterface
    {
        return $request->withAttribute('userId', "123123");
    }
}
