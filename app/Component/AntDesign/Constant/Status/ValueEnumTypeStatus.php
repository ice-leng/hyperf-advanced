<?php

namespace App\Component\AntDesign\Constant\Status;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

/**
 * 该值要渲染的状态
 * @package App\Component\AntDesign\Constant\Status
 */
class ValueEnumTypeStatus extends BaseEnum
{
    /**
     * @Message("未知")
     */
    public const UNKNOWN = '';

    /**
     * @Message("成功")
     */
    public const SUCCESS = 'Success';

    /**
     * @Message("错误")
     */
    public const ERROR = 'Error';

    /**
     * @Message("处理中")
     */
    public const PROCESSING = 'Processing';

    /**
     * @Message("警告")
     */
    public const WARNING = 'Warning';

    /**
     * @Message("默认")
     */
    public const DEFAULT = 'Default';
}
