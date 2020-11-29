<?php

namespace App\Component\AntDesign\Column;

use App\Component\AntDesign\Constant\Column\ValueEnumTypeStatus;
use Lengbin\Common\Component\BaseObject;

class ValueEnumType extends BaseObject
{
    /**
     * 展示在页面的文字
     * @var string
     */
    private $text;

    /**
     * 该值要渲染的状态
     * @var ValueEnumTypeStatus
     */
    private $status;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return ValueEnumType
     */
    public function setText(string $text): ValueEnumType
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return ValueEnumTypeStatus
     */
    public function getStatus(): ValueEnumTypeStatus
    {
        return $this->status;
    }

    /**
     * @param ValueEnumTypeStatus $status
     *
     * @return ValueEnumType
     */
    public function setStatus(ValueEnumTypeStatus $status): ValueEnumType
    {
        $this->status = $status;
        return $this;
    }

}
