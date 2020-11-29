<?php

namespace App\Component\AntDesign\Errors;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class ColumnError extends BaseEnum
{
    /**
     * @Message("值类型不支持")
     */
    public const ERROR_ANTDESIGN_COLUMN_VALUEENUMTYPE_NOT_SUPPORT = 'A-002-001-001';
}
