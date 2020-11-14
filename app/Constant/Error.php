<?php

declare(strict_types=1);

namespace App\Constant;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class Error extends BaseEnum
{
    /**
     * @Message("Success")
     */
   const ERROR_COMMENTERRORCODE_SUCCESS = '0';
   
    /**
     * @Message("系统错误")
     */
   const ERROR_COMMENTERRORCODE_SERVER_ERROR = 'F-000-000-500';
   
    /**
     * @Message("错误的请求参数")
     */
   const ERROR_COMMENTERRORCODE_INVALID_PARAMS = 'F-000-000-400';
   
    /**
     * @Message("无效权限")
     */
   const ERROR_COMMENTERRORCODE_INVALID_PERMISSION = 'F-000-000-402';
   
    /**
     * @Message("请重新登录")
     */
   const ERROR_COMMENTERRORCODE_TOKEN_EXPIRED = 'F-000-000-401';
   
    /**
     * @Message("请重新登录")
     */
   const ERROR_COMMENTERRORCODE_INVALID_TOKEN = 'F-000-000-403';
   
    /**
     * @Message("Server Error！")
     */
   const ERROR_ERRORCODE_SERVER_ERROR = '500';
   
}
