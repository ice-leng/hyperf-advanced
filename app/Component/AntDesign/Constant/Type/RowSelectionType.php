<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

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
