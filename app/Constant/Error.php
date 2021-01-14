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
     * @Message("管理员删除失败")
     */
   const ERROR_TEST_ADMINERROR_ERRORS_TEST_ADMIN_REMOVE_FAIL = 'B-001-006-001';
   
    /**
     * @Message("管理员创建失败")
     */
   const ERROR_TEST_ADMINERROR_ERRORS_TEST_ADMIN_CREATE_FAIL = 'B-001-006-002';
   
    /**
     * @Message("管理员导入失败")
     */
   const ERROR_TEST_ADMINERROR_ERRORS_TEST_ADMIN_IMPORT_FAIL = 'B-001-006-003';
   
    /**
     * @Message("管理员导出失败")
     */
   const ERROR_TEST_ADMINERROR_ERRORS_TEST_ADMIN_EXPORT_FAIL = 'B-001-006-004';
   
    /**
     * @Message("管理员不存在")
     */
   const ERROR_TEST_ADMINERROR_ERRORS_TEST_ADMIN_NOT_FOUND = 'B-001-006-005';
   
    /**
     * @Message("管理员更新失败")
     */
   const ERROR_TEST_ADMINERROR_ERRORS_TEST_ADMIN_UPDATE_FAIL = 'B-001-006-006';
   
    /**
     * @Message("错误字典生成文件失败")
     */
   const ERROR_SYSTEM_GENERATEERROR_ERROR_GENERATE_ERROR_CODE_CREATE_FAIL = 'B-001-005-001';
   
    /**
     * @Message("服务生成文件失败")
     */
   const ERROR_SYSTEM_GENERATEERROR_ERROR_GENERATE_SERVICE_CREATE_FAIL = 'B-001-005-002';
   
    /**
     * @Message("控制器生成文件失败")
     */
   const ERROR_SYSTEM_GENERATEERROR_ERROR_GENERATE_CONTROLLER_CREATE_FAIL = 'B-001-005-003';
   
    /**
     * @Message("权限不存在")
     */
   const ERROR_SYSTEM_PERMISSIONERROR_ERROR_PERMISSION_NOT_FOUND = 'B-001-004-001';
   
    /**
     * @Message("权限创建失败")
     */
   const ERROR_SYSTEM_PERMISSIONERROR_ERROR_PERMISSION_CREATE_FAIL = 'B-001-004-002';
   
    /**
     * @Message("权限更新失败")
     */
   const ERROR_SYSTEM_PERMISSIONERROR_ERROR_PERMISSION_UPDATE_FAIL = 'B-001-004-003';
   
    /**
     * @Message("权限删除失败")
     */
   const ERROR_SYSTEM_PERMISSIONERROR_ERROR_PERMISSION_REMOVE_FAIL = 'B-001-004-004';
   
    /**
     * @Message("菜单不存在")
     */
   const ERROR_SYSTEM_MENUERROR_ERROR_MENU_NOT_FOUND = 'B-001-002-001';
   
    /**
     * @Message("菜单创建失败")
     */
   const ERROR_SYSTEM_MENUERROR_ERROR_MENU_CREATE_FAIL = 'B-001-002-002';
   
    /**
     * @Message("菜单更新失败")
     */
   const ERROR_SYSTEM_MENUERROR_ERROR_MENU_UPDATE_FAIL = 'B-001-002-003';
   
    /**
     * @Message("菜单删除失败")
     */
   const ERROR_SYSTEM_MENUERROR_ERROR_MENU_REMOVE_FAIL = 'B-001-002-004';
   
    /**
     * @Message("角色不存在")
     */
   const ERROR_SYSTEM_ROLEERROR_ERROR_ROLE_NOT_FOUND = 'B-001-003-001';
   
    /**
     * @Message("角色创建失败")
     */
   const ERROR_SYSTEM_ROLEERROR_ERROR_ROLE_CREATE_FAIL = 'B-001-003-002';
   
    /**
     * @Message("角色更新失败")
     */
   const ERROR_SYSTEM_ROLEERROR_ERROR_ROLE_UPDATE_FAIL = 'B-001-003-003';
   
    /**
     * @Message("角色删除失败")
     */
   const ERROR_SYSTEM_ROLEERROR_ERROR_ROLE_REMOVE_FAIL = 'B-001-003-004';
   
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
   
    /**
     * @Message("账号已存在")
     */
   const ERROR_ADMINERROR_ERROR_ADMIN_EXIST = 'B-001-001-007';
   
}
