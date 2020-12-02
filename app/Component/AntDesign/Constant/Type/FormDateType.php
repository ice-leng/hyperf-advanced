<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class FormDateType extends BaseEnum
{
    /**
     * 日期 2020-01-01
     * @Message("日期")
     */
    public const DATE = 'date';

    /**
     * 日期和时间    2019-11-16 12: 50: 00
     * @Message("日期和时间")
     */
    public const DATE_TIME = 'dateTime';

    /**
     * 时间    12:50:00
     * @Message("时间")
     */
    public const TIME = 'time';
}
