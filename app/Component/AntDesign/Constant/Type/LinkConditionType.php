<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class LinkConditionType extends BaseEnum
{
    /**
     * @Message("且")
     */
    public const AND = 'and';

    /**
     * @Message("或")
     */
    public const OR = 'or';
}
