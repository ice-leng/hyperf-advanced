<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class SizeType extends BaseEnum
{
    /**
     * @Message("大")
     */
    public const LARGE = 'large';

    /**
     * @Message("中")
     */
    public const MIDDLE = 'middle';

    /**
     * @Message("小")
     */
    public const SMALL = 'small';
}
