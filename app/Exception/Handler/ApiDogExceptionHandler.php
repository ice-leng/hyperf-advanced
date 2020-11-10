<?php

namespace App\Exception\Handler;

use Hyperf\Apidog\Exception\ApiDogException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Lengbin\Hyperf\Common\Exception\Handler\ExceptionHandlerTrait;
use Lengbin\Hyperf\Common\Error\CommentErrorCode;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ApiDogExceptionHandler extends ExceptionHandler
{
    use ExceptionHandlerTrait;

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        $this->formatLog($throwable);
        return $this->response->fail(CommentErrorCode::INVALID_PARAMS, $throwable->getMessage());
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ApiDogException;
    }
}
