<?php

namespace App\Component\AntDesign\Table\Column;

class Search extends BaseColumn
{
    public function init()
    {
        parent::init();
        $this->setSearch(true);
        $this->setHideInSearch(false);
        $this->setHideInTable(true);
    }
}
