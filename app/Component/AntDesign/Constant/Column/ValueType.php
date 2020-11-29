<?php

namespace App\Component\AntDesign\Constant\Column;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

/**
 * value type
 * @package App\Component\AntDesign\Column
 * @document https://github.com/coderlfm/CMS
 */
class ValueType extends BaseEnum
{
    /**
     * 默认值 不做任何处理
     * @Message("文本")
     */
    public const TEXT = 'text';

    /**
     * 转化值为金额    ¥10, 000.26
     * @Message("金额")
     */
    public const MONEY = 'money';

    /**
     * 日期 2020-01-01
     * @Message("日期")
     */
    public const DATE = 'date';

    /**
     * 日期 2020-01-01 - 2020-02-01
     * @Message("日期区间")
     */
    public const DATE_RANGE = 'dateRange';

    /**
     * 日期和时间    2019-11-16 12: 50: 00
     * @Message("日期和时间")
     */
    public const DATE_TIME = 'dateTime';

    /**
     * 日期和时间区间    2019-11-16 12:50:00  2019-11-18 12:50:00
     * @Message("日期和时间")
     */
    public const DATE_TIME_RANGE = 'dateTimeRange';

    /**
     * 时间    12:50:00
     * @Message("时间")
     */
    public const TIME = 'time';

    /**
     * 操作项，会自动增加 marginRight，只支持一个数组, 表单中会自动忽略[<a>操作a</a>, <a>操作b</a>]
     * @Message("操作项")
     */
    public const OPTION = 'option';

    /**
     * 选择 配合 Column::valueEnum
     * @Message("选择")
     */
    public const SELECT = 'select';

    /**
     * 与 text 相同， form 转化时会转为 textarea 组件
     * @Message("文本域")
     */
    public const TEXTAREA = 'textarea';

    /**
     * 序号列
     * @Message("序号列")
     */
    public const INDEX = 'index';

    /**
     * 带 border 的序号列
     * @Message("带 border 的序号列")
     */
    public const INDEX_BORDER = 'indexBorder';

    /**
     * 进度条
     * @Message("进度条")
     */
    public const PROGRESS = 'progress';

    /**
     * 格式化数字展示，form 转化时会转为 inputNumber
     * @Message("格式化数字展示")
     */
    public const DIGIT = 'digit';

    /**
     * 百分比
     * @Message("百分比")
     */
    public const PERCENT = 'percent';

    /**
     * 代码块
     * @Message("代码块")
     */
    public const CODE = 'code';

    /**
     * 密码相关的展示
     * @Message("密码框")
     */
    public const PASSWORD = 'password';

    /**
     * 展示一个头像
     * @Message("头像")
     */
    public const AVATAR = 'avatar';

    /**
     * 单选
     * @Message("单选")
     */
    public const RADIO = 'radio';

    /**
     * 按钮形式单选
     * @Message("按钮形式单选")
     */
    public const RADIO_BUTTON = 'radioButton';

    /**
     * 单选
     * @Message("多选")
     */
    public const CHECKBOX = 'checkbox';

}
