<?php

namespace App\Component\AntDesign\Table;

use App\Component\AntDesign\Errors\TableError;
use Lengbin\Common\Component\BaseObject;
use Lengbin\Hyperf\Common\Exception\BusinessException;

class RowSelection extends BaseObject
{
    /**
     * 列选择 类型
     * @var string
     */
    public $type;

    private $typeAllows = ['radio', 'checkbox'];

    public function init()
    {
        if ($this->type !== null && !in_array($this->type, $this->typeAllows)) {
            throw new BusinessException(TableError::ERROR_ANTDESIGN_TABLE_ROWSELECTION_TYPE_ERROR);
        }
    }
}
