<?php

namespace App\Component\AntDesign\Search;

use App\Component\AntDesign\Constant\Type\SearchJudgeType;
use Lengbin\Common\Component\BaseObject;

class SearchJudge extends BaseObject
{
    /**
     * 属性
     * @var string
     */
    private $attribute;

    /**
     * 类型
     * @var SearchJudgeType
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
     * @return SearchJudge
     */
    public function setAttribute(string $attribute): SearchJudge
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * @return SearchJudgeType
     */
    public function getType(): SearchJudgeType
    {
        return $this->type;
    }

    /**
     * @param SearchJudgeType $type
     *
     * @return SearchJudge
     */
    public function setType(SearchJudgeType $type): SearchJudge
    {
        $this->type = $type;
        return $this;
    }
}
