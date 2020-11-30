<?php

namespace App\Component\AntDesign;

use App\Component\AntDesign\Column\BaseColumn;
use App\Component\AntDesign\Errors\TableError;
use App\Component\AntDesign\Table\Config;
use App\Component\AntDesign\Table\Search;
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
     * @var Search
     */
    public $search;

    /**
     * @var Config
     */
    public $config;

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
                $item = new BaseColumn([
                    'dataIndex' => $data[0],
                    'title'     => $data[1],
                ]);
            } elseif (is_array($item)) {
                $item = new BaseColumn($item);
            } elseif ($item instanceof BaseColumn) {

            } else {
                throw new BusinessException(TableError::ERROR_ANTDESIGN_TABLE_PARAM_ERROR);
            }
            $this->column[$key] = $item->toArray();
        }

        // TableSearch
        if ($this->search === null) {
            $this->search = new Search();
        }

        if ($this->config === null) {
            $this->config = new Config();
        }
    }
}
