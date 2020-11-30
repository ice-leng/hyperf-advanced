<?php

namespace App\Component\AntDesign\Table\Column;

class Column extends BaseColumn
{
    public function init()
    {
        // 列 支持 查询，但是不能不显示在table中
        parent::init();
        $this->setHideInTable(false);
    }
}
