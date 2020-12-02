<?php

namespace App\Component\AntDesign\Constant\Status;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

/**
 * 该值要渲染的状态
 * @package App\Component\AntDesign\Constant\Status
 */
class ProgressTypeStatus extends BaseEnum
{

    /**
     * @Message("未知")
     */
    public const UNKNOWN = '';

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
