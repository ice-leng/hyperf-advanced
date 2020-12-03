<?php

namespace App\Component\AntDesign;

use App\Component\AntDesign\Config\PageConfig;
use App\Component\AntDesign\Constant\Type\ValueType;
use App\Component\AntDesign\Errors\TableError;
use App\Component\AntDesign\Column\BaseColumn;
use App\Component\AntDesign\Column\Column;
use App\Component\AntDesign\Config\ColumnConfig;
use Lengbin\Common\Component\BaseObject;
use Lengbin\Hyperf\Common\Exception\BusinessException;

/**
 * Class Table
 * @package App\Component\AntDesign
 */
class Table extends BaseObject
{
    /**
     * @var array
     */
    public $column = [];

    /**
     * @var ColumnConfig
     */
    public $columnConfig;

    /**
     * @var PageConfig
     */
    public $pageConfig;

    /**
     * @var array
     */
    public $search;

    /**
     * @var array
     */
    public $form;

    public function init()
    {
        // column
        foreach ($this->column as $key => $item) {
            if (is_string($item)) {
                //dataIndex|title
                $data = explode('|', $item);
                if (count($data) !== 2) {
                    throw new BusinessException(TableError::ERROR_ANTDESIGN_TABLE_PARAM_ERROR);
                }
                $item = new Column([
                    'dataIndex' => $data[0],
                    'title'     => $data[1],
                    'valueType' => ValueType::TEXT,
                ]);
            } elseif (is_array($item)) {
                $item = new Column($item);
            } elseif ($item instanceof BaseColumn) {

            } else {
                throw new BusinessException(TableError::ERROR_ANTDESIGN_TABLE_PARAM_ERROR);
            }
            $this->column[$key] = $item->toArray();
        }

        if ($this->columnConfig === null) {
            $this->columnConfig = new ColumnConfig();
        }
    }
}
