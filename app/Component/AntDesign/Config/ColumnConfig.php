<?php

namespace App\Component\AntDesign\Config;

use Lengbin\Common\Component\BaseObject;

class ColumnConfig extends BaseObject
{

    /**
     * 唯一key值
     * @var string
     */
    public $rowKey = 'id';

    /**
     * 表格标题
     * @var string
     */
    public $headerTitle;

    /**
     * @var RowSelection
     */
    public $rowSelection;

    /**
     * @var Pagination
     */
    public $pagination;

    public function init()
    {
        if ($this->pagination === null) {
            $this->pagination = new Pagination();
        }
    }

}
