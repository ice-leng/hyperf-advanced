<?php

namespace App\Constant\Errors\System;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class PermissionError extends BaseEnum
{
    /**
     * @Message("权限不存在")
     */
    public const ERROR_PERMISSION_NOT_FOUND = 'B-001-004-001';

    /**
     * @Message("权限创建失败")
     */
    public const ERROR_PERMISSION_CREATE_FAIL = 'B-001-004-002';

    /**
     * @Message("权限更新失败")
     */
    public const ERROR_PERMISSION_UPDATE_FAIL = 'B-001-004-003';

    /**
     * @Message("权限删除失败")
     */
    public const ERROR_PERMISSION_REMOVE_FAIL = 'B-001-004-004';
}
