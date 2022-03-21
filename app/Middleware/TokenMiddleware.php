<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  10:46 下午
 */

declare(strict_types=1);

namespace App\Middleware;

use App\Module\Login\JwtSubject;
use Hyperf\Context\Context;
use Psr\Http\Message\ServerRequestInterface;

class TokenMiddleware extends BaseAuthMiddleware
{

    public const LOGIN_TYPE_TOKEN = 'client';

    protected function getTestPayload(ServerRequestInterface $request)
    {
        $payload = new JwtSubject();
        $payload->data = [

        ];
        return $payload;
    }

    protected function handlePayload(ServerRequestInterface $request, JwtSubject $payload): ServerRequestInterface
    {
//        $data = $payload->data;
//        $request->withAttribute('', $data['']);
        $request = $request->withAttribute('userId', "123123");
        Context::set(ServerRequestInterface::class, $request);
        return $request;
    }

    protected function validateToken(?string $token): JwtSubject
    {
        return $this->parseToken($token, function ($payload) {
//            if (empty($payload->data['user_id']) || ($payload->key !== self::LOGIN_TYPE_TOKEN)) {
//                throw new BusinessException(CommonError::INVALID_TOKEN);
//            }
            return $payload;
        });
    }


}
