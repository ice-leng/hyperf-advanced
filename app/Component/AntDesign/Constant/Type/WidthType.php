<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

/**
 * 宽度类型
 * @package App\Component\AntDesign\Constant\Type
 */
class WidthType extends BaseEnum
{
    /**
     * 104px 适用于短数字、短文本或选项。
     * @Message("XS")
     */
    public const XS = 'xs';

    /**
     * 216px 适用于较短字段录入、如姓名、电话、ID 等。
     * @Message("S")
     */
    public const S = 's';

    /**
     * 328px 标准宽度，适用于大部分字段长度。
     * @Message("M")
     */
    public const M = 'm';

    /**
     * 440px 适用于较长字段录入，如长网址、标签组、文件路径等。
     * @Message("L")
     */
    public const L = 'l';

    /**
     * 552px 适用于长文本录入，如长链接、描述、备注等，通常搭配自适应多行输入框或定高文本域使用。
     * @Message("XL")
     */
    public const XL = 'xl';
}
