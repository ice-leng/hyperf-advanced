<?php

declare(strict_types=1);

namespace Common\Exception;

use Common\Helper\CodeHelper;
use Hyperf\Server\Exception\ServerException;

class BusinessException extends ServerException
{
    public function __construct($code, string $message = null, \Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = CodeHelper::getMessage($code);
        }

        parent::__construct($message, $code, $previous);
    }
}