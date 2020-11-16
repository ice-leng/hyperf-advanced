<?php

namespace App\Constant\Errors;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class AdminError extends BaseEnum
{
    /**
     * @Message("账号被冻结，请联系管理员")
     */
    public const ERROR_ADMIN_FREEZE = 'B-001-001-001';

    /**
     * @Message("账号不存在")
     */
    public const ERROR_ADMIN_NOT_FOUND = 'B-001-001-002';

    /**
     * @Message("账号创建失败")
     */
    public const ERROR_ADMIN_CREATE_FAIL = 'B-001-001-003';

    /**
     * @Message("账号更新失败")
     */
    public const ERROR_ADMIN_UPDATE_FAIL = 'B-001-001-004';

    /**
     * @Message("账号删除失败")
     */
    public const ERROR_ADMIN_DELETE_FAIL = 'B-001-001-005';

    /**
     * @Message("账号或密码错误")
     */
    public const ERROR_ADMIN_ACCOUNT_OR_PASSWORD_FAIL = 'B-001-001-006';
}
