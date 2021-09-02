<?php

namespace App\Kernel\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 基础状态
 * @Constants()
 */
class WhetherStatus
{
    /**
     * @Message("是")
     */
    const YES = 1;

    /**
     * @Message("否")
     */
    const NO = 2;
}
