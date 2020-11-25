<?php

namespace App\Component\AntDesign\Errors;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class TableError extends BaseEnum
{
    /**
     * @Message("值类型不支持")
     */
    public const ERROR_ANTDESIGN_COLUMN_VALUETYPE_NOT_SUPPORT = 'A-001-001-001';

    /**
     * @Message("列表参数错误")
     */
    public const ERROR_ANTDESIGN_TABLE_PARAM_ERROR = 'A-001-001-002';

    /**
     * @Message("配置搜索框在该行所占的栅格, 范围 1 - 24")
     */
    public const ERROR_ANTDESIGN_TABLE_SPAN_RANGE_ERROR = 'A-001-001-003';

    /**
     * @Message("列选择类型错误")
     */
    public const ERROR_ANTDESIGN_TABLE_ROWSELECTION_TYPE_ERROR= 'A-001-001-004';
}
