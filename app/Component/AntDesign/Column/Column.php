<?php

namespace App\Component\AntDesign\Column;

class Column extends BaseColumn
{
    public function init()
    {
        parent::init();
        $this->setSearch(false);
        $this->setHideInSearch(true);
        $this->setHideInTable(false);
    }
}
