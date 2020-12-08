<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;

class ClassProperty extends BaseObject
{
    /**
     * @var bool
     */
    private $const = false;

    /**
     * @return bool
     */
    public function getConst(): bool
    {
        return $this->const;
    }

    /**
     * @param bool $const
     *
     * @return ClassProperty
     */
    public function setConst(bool $const = true): ClassProperty
    {
        $this->const = $const;
        return $this;
    }
}
