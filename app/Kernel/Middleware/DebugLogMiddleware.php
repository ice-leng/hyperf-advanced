<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  9:37 下午
 */

declare(strict_types=1);

namespace App\Kernel\Middleware;

use App\Kernel\Log\AppendRequestIdProcessor;
use Hyperf\Snowflake\IdGenerator\SnowflakeIdGenerator;
use Hyperf\Utils\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DebugLogMiddleware implements MiddlewareInterface
{

    /**
     * @var SnowflakeIdGenerator
     */
    protected SnowflakeIdGenerator $idGenerator;

    public function __construct(SnowflakeIdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        Context::getOrSet(AppendRequestIdProcessor::REQUEST_ID, $this->idGenerator->generate());
        return $handler->handle($request);
    }
}
