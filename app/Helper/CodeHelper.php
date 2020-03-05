<?php

declare(strict_types=1);

namespace App\Helper;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class CodeHelper extends AbstractConstants
{
    /**
     * @Message("请求成功")
     */
    const SYS_SUCCESS = 0;

    /**
     * @Message("请求参数错误")
     */
    const SYS_PARAMS_ERROR = 400;

    /**
     * @Message("未授权对该资源的操作")
     */
    const SYS_PERMISSION_ERROR = 403;

    /**
     * @Message("页面没有找到")
     */
    const SYS_REQUEST_ERROR = 404;

    /**
     * @Message("方法不允许")
     */
    const SYS_METHOD_NOT_ALLOWED = 405;

    /**
     * @Message("服务器内部错误")
     */
    const SYS_EXCEPTION_ERROR = 500;

    /**
     * @Message("账号未登陆")
     */
    const TOKEN_INVALID = 10;

    /**
     * @Message("账号信息已到期，请重新登录")
     */
    const TOKEN_EXPIRES = 11;

    /**
     * @Message("当前账号在其他地方登录，请重新登录")
     */
    const TOKEN_OFFLINE = 12;

    /**
     * @Message("签名错误")
     */
    const SIGN_ERROR = 13;



}
