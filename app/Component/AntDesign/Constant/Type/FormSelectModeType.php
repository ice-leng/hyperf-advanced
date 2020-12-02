<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class FormSelectModeType extends BaseEnum
{
    /**
     * @Message("多选")
     */
    public const MULTIPLE = 'multiple';

    /**
     * @Message("标签")
     */
    public const TAGS = 'tags';
}
