<?php

namespace App\Component\AntDesign\Column;

/**
 * 列
 * @package App\Component\AntDesign\Column
 */
class Column extends BaseColumn
{
    public function init()
    {
        // 列 支持 查询，但是不能不显示在table中
        parent::init();
        $this->setHideInTable(false);
    }
}
