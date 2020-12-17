<?php

namespace App\Component\Generate\ClassFile;

class ClassConstant extends ClassBase
{
    /**
     * @var mixed
     */
    protected $default;

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param mixed $default
     *
     * @return ClassConstant
     */
    public function setDefault($default): ClassConstant
    {
        $this->default = $default;
        return $this;
    }
}
