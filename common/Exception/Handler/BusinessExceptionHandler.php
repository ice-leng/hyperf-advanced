<?php

declare(strict_types=1);

namespace Common\Exception\Handler;

use Common\Exception\BusinessException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class BusinessExceptionHandler extends ExceptionHandler
{

    /**
     * Handle the exception, and return the specified result.
     *
     * @param Throwable         $throwable
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     * @throws \Nette\Utils\JsonException
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        // 判断被捕获到的异常是希望被捕获的异常
        // 格式化输出
        $data = Json::encode([
            'code'    => $throwable->getCode(),
            'message' => $throwable->getMessage(),
        ]);

        $this->stopPropagation();

        return $response->withStatus(200)->withAddedHeader('content-type', 'application/json; charset=utf-8')->withBody(new SwooleStream($data));
    }

    /**
     * Determine if the current exception handler should handle the exception,.
     *
     * @return bool
     *              If return true, then this exception handler will handle the exception,
     *              If return false, then delegate to next handler
     */
    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof BusinessException;
    }
}