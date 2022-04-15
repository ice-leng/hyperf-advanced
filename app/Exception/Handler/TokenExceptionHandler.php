<?php
/**
 * Created by PhpStorm.
 * Date:  2022/4/15
 * Time:  10:39 PM
 */

declare(strict_types=1);

namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Lengbin\Hyperf\Auth\Exception\InvalidTokenException;
use Lengbin\Hyperf\Auth\Exception\TokenExpireException;
use Lengbin\Hyperf\Common\Constants\Errors\CommonError;
use Lengbin\Hyperf\Common\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class TokenExceptionHandler extends ExceptionHandler
{
    /**
     * @var Response
     */
    protected Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        $error = $throwable instanceof TokenExpireException ? CommonError::TOKEN_EXPIRED() : CommonError::INVALID_TOKEN();
        return $this->response->fail($error->getValue(), $error->getMessage());
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof InvalidTokenException || $throwable instanceof TokenExpireException;
    }
}
