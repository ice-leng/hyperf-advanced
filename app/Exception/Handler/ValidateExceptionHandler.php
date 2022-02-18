<?php
/**
 * Created by PhpStorm.
 * Date:  2022/2/18
 * Time:  4:02 PM
 */

declare(strict_types=1);

namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\Validation\ValidationException;
use Lengbin\Hyperf\Common\Constants\Errors\CommonError;
use Lengbin\Hyperf\Common\Exceptions\BusinessException;
use Lengbin\Hyperf\Common\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidateExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    /**
     * @var Response
     */
    protected $response;

    public function __construct(StdoutLoggerInterface $logger, Response $response)
    {
        $this->logger = $logger;
        $this->response = $response;
    }

    /**
     * Handle the exception, and return the specified result.
     *
     * @param ValidationException $throwable
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $msg = sprintf("%s: %s(%s) in %s:%s\nStack trace:\n%s",
            get_class($throwable),
            $throwable->getMessage(),
            $throwable->getCode(),
            $throwable->getFile(),
            $throwable->getLine(),
            $throwable->getTraceAsString()
        );
        $this->logger->debug($msg);

        $this->stopPropagation();
        $serverError = CommonError::INVALID_PARAMS();
        $systemError = new BusinessException($serverError->getValue());
        $message = current($throwable->errors())[0];
        return $this->response->fail($systemError->getRealCode(), $message);
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
        return $throwable instanceof ValidationException;
    }
}

