<?php

namespace App\Component\AntDesign\Column;

use App\Component\AntDesign\Constant\Status\ProgressTypeStatus;
use Lengbin\Common\Component\BaseObject;

/**
 * 列值的枚举 - 进度条
 * @package App\Component\AntDesign\Column
 */
class ProgressType extends BaseObject
{
    /**
     * 展示在页面的文字
     * @var string
     */
    private $text;

    /**
     * 该值要渲染的状态
     * @var ProgressTypeStatus
     */
    private $status;
}
