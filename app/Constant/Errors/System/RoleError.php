<?php

namespace App\Constant\Errors\System;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class RoleError extends BaseEnum
{
    /**
     * @Message("角色不存在")
     */
    public const ERROR_ROLE_NOT_FOUND = 'B-001-003-001';

    /**
     * @Message("角色创建失败")
     */
    public const ERROR_ROLE_CREATE_FAIL = 'B-001-003-002';

    /**
     * @Message("角色更新失败")
     */
    public const ERROR_ROLE_UPDATE_FAIL = 'B-001-003-003';

    /**
     * @Message("角色删除失败")
     */
    public const ERROR_ROLE_REMOVE_FAIL = 'B-001-003-004';
}
