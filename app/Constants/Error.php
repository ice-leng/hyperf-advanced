<?php

declare(strict_types=1);

namespace App\Constants;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class Error extends BaseEnum
{
    /**
     * @Message("Success")
     */
    const ERROR_COMMONERROR_SUCCESS = 0;
    
    /**
     * @Message("系统错误")
     */
    const ERROR_COMMONERROR_SERVER_ERROR = 1;
    
    /**
     * @Message("无效权限")
     */
    const ERROR_COMMONERROR_INVALID_PERMISSION = 2;
    
    /**
     * @Message("错误的请求参数")
     */
    const ERROR_COMMONERROR_INVALID_PARAMS = 3;
    
    /**
     * @Message("登录已超时")
     */
    const ERROR_COMMONERROR_TOKEN_EXPIRED = 4;
    
    /**
     * @Message("请重新登录")
     */
    const ERROR_COMMONERROR_INVALID_TOKEN = 5;
    
}
