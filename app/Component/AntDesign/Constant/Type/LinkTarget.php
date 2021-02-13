<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class LinkTarget extends BaseEnum
{
    /**
     * @Message("按钮")
     */
    public const BUTTON = 'button';

    /**
     * @Message("链接")
     */
    public const LINK = 'link';

    /**
     * @Message("弹出层")
     */
    public const DIALOG = 'dialog';

    /**
     * @Message("iframe")
     */
    public const IFRAME = 'iframe';
}
