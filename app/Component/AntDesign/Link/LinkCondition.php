<?php

namespace App\Component\AntDesign\Link;

use App\Component\AntDesign\Constant\Type\LinkConditionType;
use Lengbin\Common\Component\BaseObject;

class LinkCondition extends BaseObject
{
    /**
     * 显示内容
     * @var string
     */
    private $label;

    /**
     * 判断类型
     * @var LinkConditionType
     */
    private $type;

    /**
     * 判断条件
     * @var LinkJudge[]
     */
    private $judge;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return LinkCondition
     */
    public function setLabel(string $label): LinkCondition
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return LinkConditionType
     */
    public function getType(): LinkConditionType
    {
        return $this->type;
    }

    /**
     * @param LinkConditionType $type
     *
     * @return LinkCondition
     */
    public function setType(LinkConditionType $type): LinkCondition
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return LinkJudge[]
     */
    public function getJudge(): array
    {
        return $this->judge;
    }

    /**
     * @param LinkJudge[] $judge
     *
     * @return LinkCondition
     */
    public function setJudge(array $judge): LinkCondition
    {
        $this->judge = $judge;
        return $this;
    }
}
