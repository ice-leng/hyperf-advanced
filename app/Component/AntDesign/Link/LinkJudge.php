<?php

namespace App\Component\AntDesign\Link;

use App\Component\AntDesign\Constant\Type\LinkJudgeType;
use Lengbin\Common\Component\BaseObject;

class LinkJudge extends BaseObject
{
    /**
     * 属性
     * @var string
     */
    private $attribute;

    /**
     * 值
     * @var mixed
     */
    private $value;

    /**
     * 类型
     * @var LinkJudgeType
     */
    private $type;

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * @param string $attribute
     *
     * @return LinkJudge
     */
    public function setAttribute(string $attribute): LinkJudge
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * @return LinkJudgeType
     */
    public function getType(): LinkJudgeType
    {
        return $this->type;
    }

    /**
     * @param LinkJudgeType $type
     *
     * @return LinkJudge
     */
    public function setType(LinkJudgeType $type): LinkJudge
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return LinkJudge
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
