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
     * @Message("值类型不支持")
     */
   const ERROR_TABLEERROR_ERROR_ANTDESIGN_COLUMN_VALUETYPE_NOT_SUPPORT = 'A-001-001-001';
   
    /**
     * @Message("列表参数错误")
     */
   const ERROR_TABLEERROR_ERROR_ANTDESIGN_TABLE_PARAM_ERROR = 'A-001-001-002';
   
    /**
     * @Message("配置搜索框在该行所占的栅格, 范围 1 - 24")
     */
   const ERROR_TABLEERROR_ERROR_ANTDESIGN_TABLE_SPAN_RANGE_ERROR = 'A-001-001-003';
   
    /**
     * @Message("列选择类型错误")
     */
   const ERROR_TABLEERROR_ERROR_ANTDESIGN_TABLE_ROWSELECTION_TYPE_ERROR = 'A-001-001-004';
   
    /**
     * @Message("账号被冻结，请联系管理员")
     */
   const ERROR_ADMINERROR_ERROR_ADMIN_FREEZE = 'B-001-001-001';
   
    /**
     * @Message("账号不存在")
     */
   const ERROR_ADMINERROR_ERROR_ADMIN_NOT_FOUND = 'B-001-001-002';
   
    /**
     * @Message("账号创建失败")
     */
   const ERROR_ADMINERROR_ERROR_ADMIN_CREATE_FAIL = 'B-001-001-003';
   
    /**
     * @Message("账号更新失败")
     */
   const ERROR_ADMINERROR_ERROR_ADMIN_UPDATE_FAIL = 'B-001-001-004';
   
    /**
     * @Message("账号删除失败")
     */
   const ERROR_ADMINERROR_ERROR_ADMIN_DELETE_FAIL = 'B-001-001-005';
   
    /**
     * @Message("账号或密码错误")
     */
   const ERROR_ADMINERROR_ERROR_ADMIN_ACCOUNT_OR_PASSWORD_FAIL = 'B-001-001-006';
   
}
