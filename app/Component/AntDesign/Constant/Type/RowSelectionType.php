<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

/**
 *  列 类型
 * @package App\Component\AntDesign\Constant\Type
 */
class RowSelectionType extends BaseEnum
{
    /**
     * @Message("单选")
     */
    public const RADIO = 'radio';

    /**
     * @Message("多选")
     */
    public const CHECKBOX = 'checkbox';
}
