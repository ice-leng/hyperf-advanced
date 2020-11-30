<?php

namespace App\Component\AntDesign\Constant\Status;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class ProgressTypeStatus extends BaseEnum
{
    /**
     * @Message("成功")
     */
    public const SUCCESS = 'success';

    /**
     * @Message("异常")
     */
    public const EXCEPTION = 'exception';

    /**
     * @Message("正常的")
     */
    public const NORMAL = 'normal';

    /**
     * @Message("活跃的")
     */
    public const ACTIVE = 'active';
}
