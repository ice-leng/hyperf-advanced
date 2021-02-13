<?php

namespace App\Constant\Status;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class AdminStatus extends BaseEnum
{
    /**
     * @Message("正常")
     */
    public const NORMAL = 1;

    /**
     * @Message("冻结")
     */
    public const FROZEN = 2;
}
