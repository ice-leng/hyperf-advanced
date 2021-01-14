<?php

namespace App\Component\AntDesign\Search;

use App\Component\AntDesign\Constant\Type\LinkConditionType;
use Lengbin\Common\Component\BaseObject;

class SearchCondition extends BaseObject
{

    /**
     * 判断类型
     * @var LinkConditionType
     */
    private $type;

    /**
     * 判断条件
     * @var SearchJudge[]
     */
    private $judge;

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
     * @return SearchCondition
     */
    public function setType(LinkConditionType $type): SearchCondition
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return SearchJudge[]
     */
    public function getJudge(): array
    {
        return $this->judge;
    }

    /**
     * @param SearchJudge[] $judge
     *
     * @return SearchCondition
     */
    public function setJudge(array $judge): SearchCondition
    {
        $this->judge = $judge;
        return $this;
    }
}
