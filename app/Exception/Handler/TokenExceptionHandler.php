<?php

namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Lengbin\Auth\Exception\InvalidTokenException;
use Lengbin\Hyperf\Common\Error\CommentErrorCode;
use Lengbin\Hyperf\Common\Exception\Handler\ExceptionHandlerTrait;
use Lengbin\Jwt\Exception\ExpiredJwtException;
use Lengbin\Jwt\Exception\InvalidJwtException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class TokenExceptionHandler extends ExceptionHandler
{
    use ExceptionHandlerTrait;

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        $this->formatLog($throwable);
        $code = $throwable instanceof ExpiredJwtException ? CommentErrorCode::TOKEN_EXPIRED : CommentErrorCode::INVALID_TOKEN;
        return $this->response->fail($code);
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof InvalidTokenException || $throwable instanceof InvalidJwtException || $throwable instanceof ExpiredJwtException;
    }
}
