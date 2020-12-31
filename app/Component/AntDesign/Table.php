<?php

namespace App\Component\AntDesign;

use App\Component\AntDesign\Config\PageConfig;
use App\Component\AntDesign\Constant\Type\InputType;
use App\Component\AntDesign\Constant\Type\ValueType;
use App\Component\AntDesign\Errors\TableError;
use App\Component\AntDesign\Column\BaseColumn;
use App\Component\AntDesign\Column\Column;
use App\Component\AntDesign\Config\ColumnConfig;
use App\Component\AntDesign\Form\Form;
use Lengbin\Common\Component\BaseObject;
use Lengbin\Hyperf\Common\Exception\BusinessException;

/**
 * Class Table
 * @package App\Component\AntDesign
 */
class Table extends BaseObject
{
    /**
     * @var Column[]
     */
    public $column;

    /**
     * @var ColumnConfig
     */
    public $columnConfig;

    /**
     * @var PageConfig
     */
    public $pageConfig;

    /**
     * @var Form[]
     */
    public $form;

    public function init()
    {
        if ($this->columnConfig === null) {
            $this->columnConfig = new ColumnConfig();
        }
    }
}
