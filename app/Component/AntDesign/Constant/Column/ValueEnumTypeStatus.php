<?php

namespace App\Component\AntDesign\Constant\Column;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class ValueEnumTypeStatus extends BaseEnum
{
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
