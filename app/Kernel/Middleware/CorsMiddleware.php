<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  7:30 下午
 */

declare(strict_types=1);

namespace App\Kernel\Middleware;

use Hyperf\Utils\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $header = $request->getHeaderLine('Access-Control-Request-Headers');
        if (empty($header)) {
            $header = '*';
        }

        // 设置跨域
        $response = Context::get(ResponseInterface::class);
        $response = $response->withAddedHeader('Access-Control-Expose-Headers', '*')
            ->withAddedHeader('Access-Control-Allow-Origin', '*')
            ->withAddedHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
            ->withAddedHeader('Access-Control-Allow-Headers', $header);
        Context::set(ResponseInterface::class, $response);

        if (strtoupper($request->getMethod()) == 'OPTIONS') {
            return $response;
        }

        $response = $handler->handle($request);
        return $response;
    }
}
