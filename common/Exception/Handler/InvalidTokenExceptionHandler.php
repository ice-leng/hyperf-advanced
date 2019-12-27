<?php

namespace Common\Exception\Handler;

use Common\Helper\CodeHelper;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Lengbin\Hyperf\Auth\Exception\InvalidTokenException;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class InvalidTokenExceptionHandler extends ExceptionHandler
{
    /**
     * Handle the exception, and return the specified result.
     *
     * @param \Throwable         $throwable
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     * @throws \Nette\Utils\JsonException
     */
    public function handle(\Throwable $throwable, ResponseInterface $response)
    {
        $code = CodeHelper::TOKEN_INVALID;
        $data = Json::encode([
            'code'    => $code,
            'message' => CodeHelper::getMessage($code),
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
        return $throwable instanceof InvalidTokenException;
    }
}
