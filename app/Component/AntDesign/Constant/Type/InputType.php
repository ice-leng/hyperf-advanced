<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

/**
 * 表单类型
 * @package App\Component\AntDesign\Constant\Type
 */
class InputType extends BaseEnum
{
    /**
     * @Message("文本框")
     */
    public const TEXT = 'FormText';

    /**
     * @Message("多行文本域")
     */
    public const TEXTAREA = 'FormTextarea';

    /**
     * @Message("密码")
     */
    public const PASSWORD = 'FormTextPassword';

    /**
     * @Message("多选框")
     */
    public const CHECKBOX = 'FormCheckbox';

    /**
     * @Message("下拉选择")
     */
    public const SELECT = 'FormSelect';

    /**
     * @Message("开关")
     */
    public const SWITCH = 'FormSwitch';

    /**
     * @Message("评分")
     */
    public const RATE = 'FormRate';

    /**
     * @Message("滑动输入条")
     */
    public const SLIDER = 'FormSlider';

    /**
     * @Message("日期框")
     */
    public const DATE = 'FormDatePicker';
}
