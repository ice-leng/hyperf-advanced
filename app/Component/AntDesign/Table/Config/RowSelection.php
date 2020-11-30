<?php

namespace App\Component\AntDesign\Table\Config;

use App\Component\AntDesign\Constant\Type\RowSelectionType;
use Lengbin\Common\Component\BaseObject;

class RowSelection extends BaseObject
{
    /**
     * 列选择 类型
     * @var RowSelectionType
     */
    private $type;

    /**
     * @return RowSelectionType
     */
    public function getType(): RowSelectionType
    {
        return $this->type;
    }

    /**
     * @param RowSelectionType $type
     *
     * @return RowSelection
     */
    public function setType(RowSelectionType $type): RowSelection
    {
        $this->type = $type;
        return $this;
    }
}
