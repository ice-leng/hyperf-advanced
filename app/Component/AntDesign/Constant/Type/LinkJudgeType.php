<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class LinkJudgeType extends BaseEnum
{
    /**
     * @Message("大于")
     */
    public const GREATER_THAN = '>';

    /**
     * @Message("大于等于")
     */
    public const GREATER_THAN_OR_EQUAL = '>=';

    /**
     * @Message("小于")
     */
    public const LESS_THAN = '<';

    /**
     * @Message("小于等于")
     */
    public const LESS_THAN_OR_EQUAL = '<=';

    /**
     * @Message("等于")
     */
    public const EQUAL = '=';

    /**
     * @Message("不等于")
     */
    public const NOT_EQUAL = '!=';
}
