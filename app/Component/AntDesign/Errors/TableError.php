<?php

namespace App\Component\AntDesign\Errors;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class TableError extends BaseEnum
{
    /**
     * @Message("列表参数错误")
     */
    public const ERROR_ANTDESIGN_TABLE_PARAM_ERROR = 'A-001-001-001';

    /**
     * @Message("列选择类型错误")
     */
    public const ERROR_ANTDESIGN_TABLE_ROWSELECTION_TYPE_ERROR= 'A-001-001-003';
}
