<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class LinkType extends BaseEnum
{
    /**
     * @Message("动作")
     */
    public const ACTION = 'action';

    /**
     * @Message("操作")
     */
    public const OPERATION = 'operation';

    /**
     * @Message("标签")
     */
    public const TAG = 'tag';
}
