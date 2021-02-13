<?php

namespace App\Constant\Errors\System;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class MenuError extends BaseEnum
{
    /**
     * @Message("菜单不存在")
     */
    public const ERROR_MENU_NOT_FOUND = 'B-001-002-001';

    /**
     * @Message("菜单创建失败")
     */
    public const ERROR_MENU_CREATE_FAIL = 'B-001-002-002';

    /**
     * @Message("菜单更新失败")
     */
    public const ERROR_MENU_UPDATE_FAIL = 'B-001-002-003';

    /**
     * @Message("菜单删除失败")
     */
    public const ERROR_MENU_REMOVE_FAIL = 'B-001-002-004';
}
