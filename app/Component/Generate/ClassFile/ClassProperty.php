<?php

namespace App\Component\Generate\ClassFile;

class ClassProperty extends ClassBase
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
