<?php

namespace App\Component\Generate\ClassFile;

class ClassConstant extends ClassBase
{
    /**
     * @var bool
     */
    private $const = true;

    /**
     * @return bool
     */
    public function getConst(): bool
    {
        return $this->const;
    }
}
